<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Dosen;
use App\Models\LogAktivitas as LogAktivitasModel;
use App\Models\Lokasi;
use App\Models\LowonganMagang;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\PengajuanMagang;
use App\Models\PeriodeMagang;
use App\Models\Perusahaan;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class LogAktivitas extends Controller
{
    public function index(Request $request): View
    {
        $pengguna = Auth::user()->tipe;

        $query = LogAktivitasModel::with([
            'magang.pengajuan_magang.mahasiswa', 
            'magang.pengajuan_magang.mahasiswa.program_studi', 
            'magang.pengajuan_magang.lowongan.perusahaan'
        ]);

        if ($request->filled('nama_lengkap')) {
            $query->whereHas('magang.pengajuan_magang.mahasiswa', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
            });
        }
        
        if ($request->filled('perusahaan') && $request->perusahaan !== '') {
            $query->whereHas('magang.pengajuan_magang.lowongan', function($q) use ($request) {
                $q->where('id_perusahaan_mitra', $request->perusahaan);
            });
        }
        
        if ($request->filled('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        $log_aktivitas = $query->get();
        $periode_magang = PeriodeMagang::where('status', 'AKTIF')->first();
        $status_aktivitas = ['' => 'Semua Status'] + LogAktivitasModel::pluck('status', 'status')->unique()->toArray();

        switch ($pengguna) {
            case 'ADMIN':
                $perusahaan = ['' => 'Semua Perusahaan'] + $log_aktivitas
                    ->pluck('magang.pengajuan_magang.lowongan.perusahaan')
                    ->filter()
                    ->unique('id_perusahaan_mitra')
                    ->mapWithKeys(fn($p) => [$p['id_perusahaan_mitra'] => $p['nama']])
                    ->toArray();
                    
                return view('pages.admin.aktivitas-magang', compact('log_aktivitas', 'periode_magang', 'perusahaan', 'status_aktivitas'));
            case 'DOSEN':
                $dosen = Dosen::where('id_pengguna', Auth::user()->id_pengguna)->first();
                
                if (!$dosen) {
                    return view('pages.lecturer.log-aktivitas', [
                        'log_aktivitas' => collect([]),
                        'perusahaan' => [],
                        'periode_magang' => $periode_magang,
                        'status_aktivitas' => $status_aktivitas
                    ]);
                }

                $query->whereHas('magang', function($q) use ($dosen) {
                    $q->where('id_dosen_pembimbing', $dosen->id_dosen);
                });

                if ($request->filled('nama_lengkap')) {
                    $query->whereHas('magang.pengajuan_magang.mahasiswa', function($q) use ($request) {
                        $q->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
                    });
                }
                
                if ($request->filled('perusahaan') && $request->perusahaan !== '') {
                    $query->whereHas('magang.pengajuan_magang.lowongan', function($q) use ($request) {
                        $q->where('id_perusahaan_mitra', $request->perusahaan);
                    });
                }
                
                if ($request->filled('status') && $request->status !== '') {
                    $query->where('status', $request->status);
                }

                $log_aktivitas = $query->get();
                
                $perusahaan = ['' => 'Semua Perusahaan'] + $log_aktivitas
                    ->pluck('magang.pengajuan_magang.lowongan.perusahaan')
                    ->filter()
                    ->unique('id_perusahaan_mitra')
                    ->mapWithKeys(fn($p) => [$p['id_perusahaan_mitra'] => $p['nama']])
                    ->toArray();
                    
                return view('pages.lecturer.log-aktivitas', [
                    'log_aktivitas' => $log_aktivitas,
                    'perusahaan' => $perusahaan,
                    'periode_magang' => $periode_magang,
                    'status_aktivitas' => ['' => 'Semua Status'] + $status_aktivitas
                ]);
            case 'MAHASISWA':
                $mahasiswa = Mahasiswa::where('id_pengguna', Auth::user()->id_pengguna)->first();
                if (!$mahasiswa) return view('pages.student.log-aktivitas', ['log_aktivitas' => null]);

                $pengajuan = PengajuanMagang::where('id_mahasiswa', $mahasiswa->id_mahasiswa)->first();
                if (!$pengajuan) return view('pages.student.log-aktivitas', ['log_aktivitas' => null]);

                $magang = Magang::where('id_pengajuan_magang', $pengajuan->id_pengajuan_magang)->where('status', 'AKTIF')->first();
                if (!$magang) return view('pages.student.log-aktivitas', ['log_aktivitas' => null]);

                $lowongan = LowonganMagang::where('id_lowongan', $pengajuan->id_lowongan)->first();

                $perusahaan = "N/A";
                if ($lowongan && $lowongan->id_perusahaan_mitra) {
                    $perusahaan_mitra = Perusahaan::where('id_perusahaan_mitra', $lowongan->id_perusahaan_mitra)->first();
                    $perusahaan = $perusahaan_mitra->nama ?? "N/A";
                }

                $lokasi = "N/A";
                if (!empty($perusahaan_mitra?->id_lokasi)) {
                    $lokasi = Lokasi::where('id_lokasi', $perusahaan_mitra->id_lokasi)->first();
                    $lokasi = $lokasi->nama_lokasi ?? "N/A";
                }

                $periode = "N/A";
                if ($lowongan && $lowongan->id_periode) {
                    $periode = PeriodeMagang::where('id_periode', $lowongan->id_periode)->first();
                    $periode = $periode->nama_periode ?? "N/A";
                }

                $posisi = "N/A";
                if ($lowongan && $lowongan->id_bidang) {
                    $bidang = Bidang::where('id_bidang', $lowongan->id_bidang)->first();
                    $posisi = $bidang->nama_bidang ?? "N/A";
                }

                $dospem = "N/A";
                if ($magang->id_dosen_pembimbing) {
                    $dosen = Dosen::select('nama')->where('id_dosen', $magang->id_dosen_pembimbing)->first();
                    $dospem = $dosen->nama ?? "N/A";
                }

                $status = $magang->status ?? "N/A";
                
                // Base query for log activities
                $logQuery = LogAktivitasModel::where('id_magang', $magang->id_magang);
                
                // Apply judul filter
                if ($request->filled('judul')) {
                    $logQuery->where('judul', 'like', '%' . $request->judul . '%');
                }
                
                // Apply status filter
                if ($request->filled('status') && $request->status !== '') {
                    $logQuery->where('status', $request->status);
                }
                
                // Get the results
                $log_aktivitas = $logQuery->orderBy('created_at', 'desc')->get();
                $total_log = $log_aktivitas->count();
                $minggu = $log_aktivitas->sortBy('minggu')->pluck('minggu')->first();
                
                // Get unique statuses for filter
                $status_aktivitas = ['' => 'Semua Status'] + LogAktivitasModel::where('id_magang', $magang->id_magang)
                    ->pluck('status', 'status')
                    ->unique()
                    ->toArray();

                return view('pages.student.log-aktivitas', compact('dospem', 'log_aktivitas', 'periode', 'perusahaan', 'posisi', 'status', 'total_log', 'lokasi', 'minggu', 'status_aktivitas'));
            default:
                abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function create(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'minggu'     => 'required|integer|min:1',
                'judul'      => 'required|string|max:255',
                'deskripsi'  => 'required|string',
                'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $mahasiswa = Mahasiswa::where('id_pengguna', Auth::user()->id_pengguna)->first();
            if (!$mahasiswa) return back()->withErrors(['errors' => 'Mahasiswa tidak ditemukan.']);

            $pengajuan = PengajuanMagang::where('id_mahasiswa', $mahasiswa->id_mahasiswa)->first();
            if (!$pengajuan) return back()->withErrors(['errors' => 'Pengajuan magang tidak ditemukan.']);

            $magang = Magang::where('id_pengajuan_magang', $pengajuan->id_pengajuan_magang)->where('status', 'AKTIF')->first();
            if (!$magang) return back()->withErrors(['errors' => 'Magang aktif tidak ditemukan.']);

            if ($request->hasFile('foto')) {
                $filename = time() . '.' . $request->file('foto')->getClientOriginalExtension();
                $path = $request->file('foto')->storeAs('logs', $filename, 'public');
                $foto = "/storage/{$path}";
            }

            LogAktivitasModel::insert([
                'id_magang'  => $magang->id_magang,
                'minggu'     => $validated['minggu'],
                'judul'      => $validated['judul'],
                'deskripsi'  => $validated['deskripsi'],
                'foto'       => $foto,
                'status'     => 'MENUNGGU',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return to_route('mahasiswa.log-aktivitas')->with('success', 'Log aktivitas berhasil ditambahkan.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal dalam membuat log aktivitas baru karena kesalahan pada server.']);
        }
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'minggu'     => 'required|integer|min:1',
                'judul'      => 'required|string|max:255',
                'deskripsi'  => 'required|string',
                'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $log = LogAktivitasModel::findOrFail($id);

            if ($request->hasFile('foto')) {
                $filename = time() . '.' . $request->file('foto')->getClientOriginalExtension();
                $path = $request->file('foto')->storeAs('logs', $filename, 'public');
                $validated['foto'] = "/storage/{$path}";
            }

            $log->update($validated);

            return to_route('mahasiswa.log-aktivitas')->with('success', 'Log aktivitas berhasil diperbarui.');
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Log aktivitas tidak ditemukan.']);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal dalam memperbarui log aktivitas karena kesalahan pada server.']);
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        try {
            LogAktivitasModel::findOrFail($request->id)->delete();
            return to_route('mahasiswa.log-aktivitas');
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Log aktivitas tidak ditemukan.']);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal dalam menghapus log aktivitas karena kesalahan pada server.']);
        }
    }

    public function detail(string $id): JsonResponse
    {
        try {
            $log_aktivitas = LogAktivitasModel::with([
                'magang.pengajuan_magang.lowongan.perusahaan.lokasi',
                'magang.pengajuan_magang.lowongan.bidang',
                'magang.dosen_pembimbing.dosen'
            ])->findOrFail($id);

            return response()->json([
                'minggu'          => $log_aktivitas->minggu ?? 'N/A',
                'judul'           => $log_aktivitas->judul ?? 'N/A',
                'deskripsi'       => $log_aktivitas->deskripsi ?? 'N/A',
                'foto'            => $log_aktivitas->foto ? asset($log_aktivitas->foto) : null,
                'nama_perusahaan' => $log_aktivitas->magang->pengajuan_magang->lowongan->perusahaan->nama ?? 'N/A',
                'nama_lokasi'     => $log_aktivitas->magang->pengajuan_magang->lowongan->perusahaan->lokasi->nama_lokasi ?? 'N/A',
                'nama_bidang'     => $log_aktivitas->magang->pengajuan_magang->lowongan->bidang->nama_bidang ?? 'N/A',
                'nama_dosen'      => $log_aktivitas->magang->dosen_pembimbing->dosen->nama ?? 'N/A',
            ]);
        } catch (ModelNotFoundException $e) {
            report($e);
            return response()->json(['error' => 'Log aktivitas tidak ditemukan.'], 404);
        } catch (Exception $e) {
            report($e);
            return response()->json(['error' => 'Terjadi kesalahan pada server.'], 500);
        }
    }

    /**
     * Confirm a log activity
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm(string $id, Request $request): JsonResponse
    {
        try {
            $request->validate([
                'comment' => 'nullable|string|max:1000'
            ]);
            
            $log = LogAktivitasModel::findOrFail($id);
            
            if ($log->status !== 'MENUNGGU') {
                return response()->json([
                    'success' => false,
                    'message' => 'Log aktivitas ini sudah diproses sebelumnya.'
                ], 400);
            }
            
            $log->update([
                'status' => 'DISETUJUI',
                'komentar' => $request->input('comment'),
                'tanggal_konfirmasi' => now(),
                'updated_at' => now()
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Log aktivitas berhasil disetujui.'
            ]);
            
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Log aktivitas tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error confirming log activity: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyetujui log aktivitas.'
            ], 500);
        }
    }
    
    /**
     * Reject a log activity
     *
     * @param string $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reject(string $id, Request $request): JsonResponse
    {
        try {
            $request->validate([
                'comment' => 'nullable|string|max:1000'
            ]);
            
            $log = LogAktivitasModel::findOrFail($id);
            
            if ($log->status !== 'MENUNGGU') {
                return response()->json([
                    'success' => false,
                    'message' => 'Log aktivitas ini sudah diproses sebelumnya.'
                ], 400);
            }
            
            $log->update([
                'status' => 'DITOLAK',
                'komentar' => $request->input('comment'),
                'tanggal_konfirmasi' => now(),
                'updated_at' => now()
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Log aktivitas berhasil ditolak.'
            ]);
            
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Log aktivitas tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error rejecting log activity: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menolak log aktivitas.'
            ], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $log_aktivitas = LogAktivitasModel::with(['magang.mahasiswa.pengguna', 'magang.mahasiswa.program_studi', 'magang.pengajuan_magang.lowongan'])->findOrFail($id);

            return response()->json([
                'nama'          => $log_aktivitas->magang->pengajuan_magang->mahasiswa->nama_lengkap ?? 'N/A',
                'program_studi' => $log_aktivitas->magang->pengajuan_magang->mahasiswa->program_studi->nama ?? 'N/A',
                'judul'         => $log_aktivitas->judul ?? 'N/A',
                'deskripsi'     => $log_aktivitas->deskripsi ?? 'N/A',
                'status'        => $log_aktivitas->magang->pengajuan_magang->status ?? 'N/A',
            ]);
        } catch (ModelNotFoundException $e) {
            report($e);
            return response()->json(['error' => 'Log aktivitas tidak ditemukan.'], 404);
        } catch (Exception $e) {
            report($e);
            return response()->json(['error' => 'Terjadi kesalahan pada server.'], 500);
        }
    }
    
    /**
     * Show log activity detail for lecturer
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail_for_lecturer(string $id): JsonResponse
    {
        try {
            $dosen = Dosen::where('id_pengguna', Auth::id())->firstOrFail();

            $log = LogAktivitasModel::with(['magang.pengajuan_magang.mahasiswa.pengguna', 'magang.pengajuan_magang.lowongan.perusahaan', 'magang.pengajuan_magang.lowongan.bidang'])
                ->whereHas('magang', function ($q) use ($dosen) {
                    $q->where('id_dosen_pembimbing', $dosen->id_dosen);
                })
                ->findOrFail($id);

            $mahasiswa = $log->magang->pengajuan_magang->mahasiswa;

            $fotoUrl = null;
            if ($log->foto) {
                $fotoPath = $log->foto;

                if (str_starts_with($fotoPath, 'storage/app/public/')) {
                    $relativePath = substr($fotoPath, 19);
                    $fotoUrl = asset('storage/' . $relativePath);
                } elseif (str_starts_with($fotoPath, 'app/public/')) {
                    $relativePath = substr($fotoPath, 11);
                    $fotoUrl = asset('storage/' . $relativePath);
                } elseif (str_starts_with($fotoPath, 'public/')) {
                    $relativePath = substr($fotoPath, 7);
                    $fotoUrl = asset('storage/' . $relativePath);
                } elseif (str_starts_with($fotoPath, '/storage/')) {
                    $fotoUrl = asset($fotoPath);
                } else {
                    $fotoUrl = asset( $fotoPath);
                }
            }

            $fotoProfilUrl = asset('shared/profil.png');
            if ($mahasiswa->pengguna->foto_profil) {
                $profilePath = $mahasiswa->pengguna->foto_profil;
                
                if (str_starts_with($profilePath, 'storage/app/public/')) {
                    $relativePath = substr($profilePath, 19);
                    $fotoProfilUrl = asset('storage/' . $relativePath);
                } elseif (str_starts_with($profilePath, 'app/public/')) {
                    $relativePath = substr($profilePath, 11);
                    $fotoProfilUrl = asset('storage/' . $relativePath);
                } elseif (str_starts_with($profilePath, 'public/')) {
                    $relativePath = substr($profilePath, 7);
                    $fotoProfilUrl = asset('storage/' . $relativePath);
                } elseif (str_starts_with($profilePath, '/storage/')) {
                    $fotoProfilUrl = asset($profilePath);
                } else {
                    $fotoProfilUrl = asset('storage/' . $profilePath);
                }
            }

            $data = [
                'minggu' => $log->minggu,
                'judul' => $log->judul,
                'deskripsi' => $log->deskripsi,
                'foto' => $fotoUrl,
                'foto_profil' => $fotoProfilUrl,
                'nama_mahasiswa' => $mahasiswa->nama_lengkap ?? '-',
                'nim' => $mahasiswa->nim ?? '-',
                'status' => $log->status,
                'komentar' => $log->komentar ?? '-',
                'dikonfirmasi_pada' => $log->dikonfirmasi_pada ? $log->dikonfirmasi_pada->format('d F Y H:i') : '-',
            ];

            return response()->json($data);
        } catch (ModelNotFoundException $e) {
            Log::error('Lecturer detail not found: ' . $e->getMessage());
            return response()->json([
                'message' => 'Log aktivitas tidak ditemukan atau Anda tidak memiliki akses',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            Log::error('Error fetching lecturer log activity detail: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil detail log aktivitas',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Show log activity detail for admin
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detailForAdmin(string $id): JsonResponse
    {
        try {
            $log = LogAktivitasModel::with([
                'magang.pengajuan_magang.mahasiswa.pengguna',
                'magang.pengajuan_magang.lowongan.perusahaan',
                'magang.pengajuan_magang.lowongan.bidang',
                'magang.dosen_pembimbing'
            ])->findOrFail($id);

            $mahasiswa = $log->magang->pengajuan_magang->mahasiswa;

            $fotoUrl = null;
            if ($log->foto) {
                $fotoPath = $log->foto;
                
                if (str_starts_with($fotoPath, '/storage/')) {
                    $fotoUrl = asset($fotoPath);
                } elseif (str_starts_with($fotoPath, 'storage/')) {
                    $fotoUrl = asset($fotoPath);
                } else {
                    $fotoUrl = asset('storage/' . $fotoPath);
                }
            }

            $fotoProfilUrl = asset('images/default-avatar.png');
            if ($mahasiswa->pengguna->foto_profil) {
                $profilePath = $mahasiswa->pengguna->foto_profil;
                
                if (str_starts_with($profilePath, '/storage/')) {
                    $fotoProfilUrl = asset($profilePath);
                } elseif (str_starts_with($profilePath, 'storage/')) {
                    $fotoProfilUrl = asset($profilePath);
                } else {
                    $fotoProfilUrl = asset('storage/' . $profilePath);
                }
            }

            $data = [
                'minggu' => $log->minggu,
                'judul' => $log->judul,
                'deskripsi' => $log->deskripsi,
                'foto' => $fotoUrl,
                'foto_profil' => $fotoProfilUrl,
                'nama_mahasiswa' => $mahasiswa->nama_lengkap ?? '-',
                'nim' => $mahasiswa->nim ?? '-',
                'status' => $log->status,
                'komentar' => $log->komentar ?? '-',
                'dikonfirmasi_pada' => $log->dikonfirmasi_pada ? $log->dikonfirmasi_pada->format('d F Y H:i') : '-',
            ];

            return response()->json($data);
        } catch (ModelNotFoundException $e) {
            Log::error('Admin detail not found: ' . $e->getMessage());
            return response()->json([
                'message' => 'Log aktivitas tidak ditemukan',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            Log::error('Error fetching admin log activity detail: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil detail log aktivitas',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}