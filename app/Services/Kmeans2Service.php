<?php

namespace App\Services;

class Kmeans2Service
{
    protected $iterationOneGradeService;

    public function __construct(IterationOneGradeService $iterationOneGradeService)
    {
        $this->iterationOneGradeService = $iterationOneGradeService;
    }

    public function clusterGrades(int $k, int $maxIterations = 100): void
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
                    $grade->solusi_entrepreneurship,
                    $grade->tata_kelola_teknologi_informasi,
                    $grade->analisis_dan_perancangan_sistem_informasi,
                    $grade->komunikasi_antar_personal,
                    $grade->pemrograman_berorientasi_objek,
                    $grade->prak_pemrograman_berorientasi_objek,
                    $grade->perancangan_dan_pengelolaan_jaringan_komputer,
                    $grade->prak_perancangan_dan_pengelolaan_jaringan_komputer,
                    $grade->kecerdasan_buatan,
                    $grade->kewarganegaraan,
                    $grade->pemrograman_berbasis_web,
                    $grade->prak_pemrograman_berbasis_web,
                    $grade->sekuriti_sistem_informasi,
                    $grade->probabilistik_dan_statistik,
                    $grade->prak_probabilistik_dan_statistik,
                    $grade->sistem_informasi_manajemen,
                    $grade->proyek_aplikasi_sistem_informasi,
                    $grade->prak_proyek_aplikasi_sistem_informasi
                ]
            ];
        })->toArray();

        $result = $this->kmeans($data, $k, $maxIterations);

        $totalDataCount = count($data);
        $labelsPhp = $this->getLabelsArray($result['clusters'], $totalDataCount);


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
                $grade->C1 = $distances[0] ?? null;
                $grade->C2 = $distances[1] ?? null;
                $grade->C3 = $distances[2] ?? null;
                $grade->C4 = $distances[3] ?? null;
                $grade->save();
            }
        }

        dd($result);
    }

    public function kmeans(array $data, int $k, int $maxIterations = 100): array
    {
        // Initialize centroids with first 4 data (integer key 0..k-1)
        $centroids = $this->initializeCentroids($data, $k);

        for ($iteration = 0; $iteration < $maxIterations; $iteration++) {
            // Assign data points to nearest centroid
            $clusters = $this->assignClusters($data, $centroids);

            // Calculate new centroids
            $newCentroids = $this->calculateCentroids($clusters[0]);

            // Check convergence
            if ($this->hasConverged($centroids, $newCentroids)) {
                break;
            }

            $centroids = $newCentroids;
        }

        return [
            'centroids' => $centroids,
            'clusters' => $clusters[0],
            'distanceValues' => $clusters[1]
        ];
    }

    private function initializeCentroids(array $data, int $k): array
    {
        $centroids = [];
        $dataKeys = array_keys($data);
        $id = [1,35,36,56];
        for ($i = 0; $i < $k; $i++) {
            $centroids[$i] = $data[$id[$i]];
        }
        return $centroids;
    }

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

            // Find closest centroid (integer key)
            $closestCentroidKey = array_keys($distances, min($distances))[0];
            $clusters[$closestCentroidKey][$key] = $point;
        }

        return [$clusters, $distanceValue];
    }

    private function calculateCentroids(array $clusters): array
    {
        $centroids = [];

        foreach ($clusters as $key => $cluster) {
            $centroids[$key] = array_map(
                fn(...$values) => array_sum($values) / count($values),
                ...$cluster
            );
        }

        return $centroids;
    }

    public function distance(array $point1, array $point2): float
    {
        return sqrt(array_sum(array_map(
            fn($a, $b) => ($a - $b) ** 2,
            $point1,
            $point2
        )));
    }

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

    /**
     * Generate labels array from clusters result (for comparison with scikit-learn)
     * Result: array where key = data index (0..n), value = cluster number (0..k-1)
     *
     * @param array $clusters
     * @param int $totalDataCount
     * @return array
     */
    public function getLabelsArray(array $clusters, int $totalDataCount): array
    {
        $labels = array_fill(0, $totalDataCount, -1); // inisialisasi semua -1 (belum dikasih label)

        foreach ($clusters as $clusterNumber => $members) {
            foreach ($members as $dataIndex => $point) {
                $labels[$dataIndex] = $clusterNumber;
            }
        }

        return $labels;
    }

}
