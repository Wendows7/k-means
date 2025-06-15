<?php

namespace App\Services;


class KmeansService
{
    protected $iterationOneGradeService;
    protected $iterationTwoGradeService;
    protected  $iterationThreeGradeService;
    protected $clusterService;
    public function __construct(IterationOneGradeService $iterationOneGradeService, ClusterService $clusterService,
                                IterationTwoGradeService $iterationTwoGradeService, IterationThreeGradeService $iterationThreeGradeService)
    {
        $this->iterationOneGradeService = $iterationOneGradeService;
        $this->clusterService = $clusterService;
        $this->iterationTwoGradeService = $iterationTwoGradeService;
        $this->iterationThreeGradeService = $iterationThreeGradeService;
    }

    public function clusterGrades(int $k, int $maxIterations, $iteration)
    {
        if ($iteration == 1)
        {
            $grades = $this->iterationOneGradeService->getAllGrades();
            $data = $grades->mapWithKeys(function ($grade) {
                return [
                    $grade->id => [
                        $grade->agama,
                        $grade->pancasila,
                        $grade->pengantar_teknologi_informasi,
                        $grade->organisasi_dan_manajemen,
                        $grade->pangkalan_data,
                        $grade->prak_pangkalan_data,
                        $grade->bahasa_pemrograman,
                        $grade->prak_bahasa_pemrograman,
                        $grade->english_for_entrepreneurship,
                        $grade->bahasa_indonesia,
                        $grade->matematika_diskrit,
                        $grade->analisis_proses_bisnis,
                        $grade->sistem_operasi,
                        $grade->prak_sistem_operasi,
                        $grade->struktur_data,
                        $grade->prak_struktur_data,
                        $grade->tata_kelola_teknologi_informasi,
                        $grade->solusi_entrepreneurship,
                        $grade->analisis_dan_perancangan_sistem_informasi,
                        $grade->komunikasi_antar_personal,
                        $grade->pemrograman_berorientasi_objek,
                        $grade->prak_pemrograman_berorientasi_objek,
                        $grade->perancangan_dan_pengelolaan_jaringan_komputer,
                        $grade->prak_perancangan_dan_pengelolaan_jaringan_komputer,
                        $grade->pemrograman_berbasis_web,
                        $grade->prak_pemrograman_berbasis_web,
                        $grade->kecerdasan_buatan,
                        $grade->sekuriti_sistem_informasi,
                        $grade->probabilistik_dan_statistik,
                        $grade->prak_probabilistik_dan_statistik,
                        $grade->sistem_informasi_manajemen,
                        $grade->kewarganegaraan,
                    ]
                ];
            })->toArray();
        }
        else if ($iteration == 2)
        {
            $grades = $this->iterationTwoGradeService->getAllGrades();
            $data = $grades->mapWithKeys(function ($grade) {
                return [
                    $grade->id => [
                        $grade->agama,
                        $grade->pancasila,
                        $grade->pengantar_teknologi_informasi,
                        $grade->organisasi_dan_manajemen,
                        $grade->pangkalan_data,
                        $grade->prak_pangkalan_data,
                        $grade->bahasa_pemrograman,
                        $grade->prak_bahasa_pemrograman,
                        $grade->english_for_entrepreneurship,
                        $grade->bahasa_indonesia,
                        $grade->matematika_diskrit,
                        $grade->analisis_proses_bisnis,
                        $grade->sistem_operasi,
                        $grade->prak_sistem_operasi,
                        $grade->struktur_data,
                        $grade->prak_struktur_data,
                        $grade->tata_kelola_teknologi_informasi,
                        $grade->solusi_entrepreneurship,
                        $grade->analisis_dan_perancangan_sistem_informasi,
                        $grade->komunikasi_antar_personal,
                        $grade->pemrograman_berorientasi_objek,
                        $grade->prak_pemrograman_berorientasi_objek,
                        $grade->perancangan_dan_pengelolaan_jaringan_komputer,
                        $grade->prak_perancangan_dan_pengelolaan_jaringan_komputer,
                        $grade->pemrograman_berbasis_web,
                        $grade->prak_pemrograman_berbasis_web,
                        $grade->kecerdasan_buatan,
                        $grade->sekuriti_sistem_informasi,
                        $grade->probabilistik_dan_statistik,
                        $grade->prak_probabilistik_dan_statistik,
                        $grade->sistem_informasi_manajemen,
                        $grade->kewarganegaraan,
                        $grade->rekayasa_perangkat_lunak,
                        $grade->teknologi_open_source,
                        $grade->prak_teknologi_open_source,
                        $grade->manajemen_proyek_si,
                        $grade->fundamental_data_sains,
                        $grade->e_bisnis,
                        $grade->data_mining,
                        $grade->sistem_informasi_perusahaan,
                        $grade->e_commerce,
                        $grade->business_proses_reenginering,
                    ]
                ];
            })->toArray();
        }
        else if ($iteration == 3)
        {
            $grades = $this->iterationThreeGradeService->getAllGrades();
            $data = $grades->mapWithKeys(function ($grade) {
                return [
                    $grade->id => [
                        $grade->agama,
                        $grade->pancasila,
                        $grade->pengantar_teknologi_informasi,
                        $grade->organisasi_dan_manajemen,
                        $grade->pangkalan_data,
                        $grade->prak_pangkalan_data,
                        $grade->bahasa_pemrograman,
                        $grade->prak_bahasa_pemrograman,
                        $grade->english_for_entrepreneurship,
                        $grade->bahasa_indonesia,
                        $grade->matematika_diskrit,
                        $grade->analisis_proses_bisnis,
                        $grade->sistem_operasi,
                        $grade->prak_sistem_operasi,
                        $grade->struktur_data,
                        $grade->prak_struktur_data,
                        $grade->tata_kelola_teknologi_informasi,
                        $grade->solusi_entrepreneurship,
                        $grade->analisis_dan_perancangan_sistem_informasi,
                        $grade->komunikasi_antar_personal,
                        $grade->pemrograman_berorientasi_objek,
                        $grade->prak_pemrograman_berorientasi_objek,
                        $grade->perancangan_dan_pengelolaan_jaringan_komputer,
                        $grade->prak_perancangan_dan_pengelolaan_jaringan_komputer,
                        $grade->pemrograman_berbasis_web,
                        $grade->prak_pemrograman_berbasis_web,
                        $grade->kecerdasan_buatan,
                        $grade->sekuriti_sistem_informasi,
                        $grade->probabilistik_dan_statistik,
                        $grade->prak_probabilistik_dan_statistik,
                        $grade->sistem_informasi_manajemen,
                        $grade->kewarganegaraan,
                        $grade->rekayasa_perangkat_lunak,
                        $grade->teknologi_open_source,
                        $grade->prak_teknologi_open_source,
                        $grade->manajemen_proyek_si,
                        $grade->fundamental_data_sains,
                        $grade->e_bisnis,
                        $grade->data_mining,
                        $grade->sistem_informasi_perusahaan,
                        $grade->e_commerce,
                        $grade->business_proses_reenginering,
                        $grade->metode_penelitian,
                        $grade->arsitektur_si_ti,
                        $grade->proyek_aplikasi_si,
                        $grade->prak_proyek_aplikasi_si,
                        $grade->kuliah_kerja_nyata,
                        $grade->enterprise_resource_planning,
                        $grade->machine_learning,
                        $grade->sistem_pendukung_keputusan,
                        $grade->digital_marketing,
                        $grade->sistem_informasi_pemerintahan,
                    ]
                ];
            })->toArray();
        }

        $result = $this->kmeans($data, $k, $maxIterations);

        // Map each grade id to its cluster
        $gradeClusterMap = [];
        foreach ($result['clusters'] as $clusterKey => $members) {
            foreach ($members as $id => $point) {
                $gradeClusterMap[$id] = $clusterKey;
            }
        }
        foreach ($grades as $grade) {
            $clusterKey = $gradeClusterMap[$grade->id] ?? null;
            if ($clusterKey !== null) {
                $grade->cluster_1 = $clusterKey;
                $distances = $result['distanceValues'][$grade->id] ?? [];
                $grade->C1 = $distances['C1'] ?? null;
                $grade->C2 = $distances['C2'] ?? null;
                $grade->C3 = $distances['C3'] ?? null;
                $grade->C4 = $distances['C4'] ?? null;

                $otherDistances = $distances;
                unset($otherDistances[$clusterKey]);
                if (!empty($otherDistances)) {
                    $closestOtherCluster = array_keys($otherDistances, min($otherDistances))[0];
                    $grade->cluster_2 = $closestOtherCluster;
                } else {
                    $grade->cluster_2 = null;
                }

                $grade->save();
            }
        }

        return true;
    }
    /**
     * Perform K-means clustering on the given data.
     *
     * @param array $data
     * @param int $k
     * @param int $maxIterations
     * @return array
     */
    public function kmeans(array $data, int $k, int $maxIterations = 100): array
    {
        // Initialize centroids with first 4 data (same as your initializeCentroids function)
        $centroids = $this->initializeCentroids($data, $k);

        for ($iteration = 0; $iteration < $maxIterations; $iteration++) {
            // Assign data points to the nearest centroid
            $clusters = $this->assignClusters($data, $centroids);

            // Calculate new centroids
            $newCentroids = $this->calculateCentroids($clusters[0]);

            // Check for convergence with tolerance
            if ($this->hasConverged($centroids, $newCentroids)) {
                break;
            }

            $centroids = $newCentroids;
        }

        return [
            'centroids' => $centroids,
            'clusters' => $clusters[0],
            'distanceValues' => $clusters[1] // Return distance values for each point
        ];
    }


    /**
     * Initialize centroids randomly from the data points.
     *
     * @param array $data
     * @param int $k
     * @return array
     */
    private function initializeCentroids(array $data, int $k): array
    {
        $centroidsWithKeys = [];
        $dataKeys = array_keys($data);
        $id = [1,35,36,56];
        for ($i = 0; $i < $k; $i++) {
            $centroidsWithKeys['C' . ($i + 1)] = $data[$dataKeys[$i]];
        }
        return $centroidsWithKeys;
    }

    /**
     * Assign each data point to the nearest centroid.
     *
     * @param array $data
     * @param array $centroids
     * @return array
     */
//    private function assignClusters(array $data, array $centroids): array
//    {
//        $clusters = [];
//
//        $clusterKeys = $this->clusterService->getClusterByIteration(1)->get(['cluster_1', 'cluster_2','cluster_3', 'cluster_4'])->toArray();
//
//        foreach ($data as $point) {
//            $distances = array_map(fn($centroid) => $this->distance($point, $centroid), $centroids);
//            $closestCentroidIndex = array_keys($distances, min($distances))[0];
//            $clusters[$closestCentroidIndex][] = $point;
//        }
//        dd($clusters);
//
//        return $clusters;
//    }

    private function assignClusters(array $data, array $centroids): array
    {
        $clusters = [];
        $distanceValue = [];

        foreach ($data as $key => $point) {
            $distances = [];
            foreach ($centroids as $centroidKey => $centroid) {
                $distances[$centroidKey] = $this->distance($point, $centroid);
            }
            $distanceValue[$key] = $distances;

            // Find the closest centroid by key
            $closestCentroidKey = array_keys($distances, min($distances))[0];
            $clusters[$closestCentroidKey][$key] = $point;
        }
        return [$clusters, $distanceValue];
    }

    /**
     * Calculate new centroids as the mean of the clusters.
     *
     * @param array $clusters
     * @return array
     */
    private function calculateCentroids(array $clusters): array
    {
        $centroids = [];

        foreach ($clusters as $key => $cluster) {
            // Calculate the mean for each cluster
            $centroids[$key] = array_map(
                fn(...$values)  => array_sum($values) / count($values),
                ...$cluster
            );
        }

        return $centroids;
    }

    /**
     * Calculate the distance between two points (Euclidean distance).
     *
     * @param array $point1
     * @param array $point2
     * @return float
     */
    public function distance(array $point1, array $point2): float
    {
        return sqrt(array_sum(array_map(
            fn($a, $b) => ($a - $b) ** 2,
            $point1,
            $point2
        )));
    }

    /**
     * Check if centroids have converged using tolerance.
     *
     * @param array $oldCentroids
     * @param array $newCentroids
     * @param float $tolerance
     * @return bool
     */
    private function hasConverged(array $oldCentroids, array $newCentroids, float $tolerance = 1e-4): bool
    {
        foreach ($oldCentroids as $key => $centroid) {
            foreach ($centroid as $i => $value) {
                if (abs($value - $newCentroids[$key][$i]) > $tolerance) {
                    return false;
                }
            }
        }
        return true;
    }


}
