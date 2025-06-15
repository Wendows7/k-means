<?php

namespace App\Http\Controllers;

use App\Services\IterationOneGradeService;
use App\Services\IterationTwoGradeService;
use App\Services\IterationThreeGradeService;
use App\Services\ProfileKelulusanService;
use App\Services\IterationFinalGradeService;
use App\Services\KmeansService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\ClusterService;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $iterationOneGradeService;
    protected $iterationTwoGradeService;
    protected $iterationThreeGradeService;
    protected $clusterService;
    protected $kmeansService;
    protected $profileKelulusanService;
    protected $iterationFinalGradeService;
    protected $authService;

    public  function __construct(IterationOneGradeService $iterationOneGradeService, ClusterService $clusterService,
                                 IterationTwoGradeService $iterationTwoGradeService, KmeansService $kmeansService,
                                 IterationThreeGradeService $iterationThreeGradeService, ProfileKelulusanService $profileKelulusanService,
                                 IterationFinalGradeService $iterationFinalGradeService, AuthService $authService)
    {
        $this->iterationOneGradeService = $iterationOneGradeService;
        $this->clusterService = $clusterService;
        $this->iterationTwoGradeService = $iterationTwoGradeService;
        $this->kmeansService = $kmeansService;
        $this->iterationThreeGradeService = $iterationThreeGradeService;
        $this->profileKelulusanService = $profileKelulusanService;
        $this->iterationFinalGradeService = $iterationFinalGradeService;
        $this->authService = $authService;
    }

    public function mining(Request $request)
    {
        $iteration = $request->iteration;
        $result = $this->kmeansService->clusterGrades(4, 100, $iteration);

        if ($result) {
            return redirect()->route("kmeans.iteration_" . $iteration)->with(['success' => 'Mining successfully', 'result' => $result]);
        }else
        {
            return redirect()->back()->with(['error' => 'Mining failed']);
        }
    }

    public function iteration_1()
    {
        $title = 'Delete All Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $data = $this->iterationOneGradeService->getAllGrades();
        $cluster = $this->clusterService->getClusterByIteration(1);
        return view('kmeans.iteration_1.index', compact('data', 'cluster'));
    }

    public function iteration_2()
    {
        $title = 'Delete All Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $data = $this->iterationTwoGradeService->getAllGrades();
        $cluster = $this->clusterService->getClusterByIteration(2);
        return view('kmeans.iteration_2.index', compact('data', 'cluster'));
    }

    public function iteration_3()
    {
        $title = 'Delete All Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);


        $data = $this->iterationThreeGradeService->getAllGrades();
        $cluster = $this->clusterService->getClusterByIteration(3);
        return view('kmeans.iteration_3.index', compact('data', 'cluster'));
    }

    public function importDataByExcel(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            if ($extension == 'xlsx' || $extension == 'xls') {
                if ($request->iteration == 1){
                    $this->iterationOneGradeService->importExcel($file);
                    return redirect()->back()->with(['success' => 'Data successfully imported']);
                }elseif ($request->iteration == 2) {
                    $this->iterationTwoGradeService->importExcel($file);
                    return redirect()->back()->with(['success' => 'Data successfully imported']);
                }elseif ($request->iteration == 3) {
                    $this->iterationThreeGradeService->importExcel($file);
                    return redirect()->back()->with(['success' => 'Data successfully imported']);
                }
                elseif ($request->iteration == 'profile_kelulusan') {
                    $this->profileKelulusanService->importExcel($file);
                    return redirect()->back()->with(['success' => 'Profile Kelulusan successfully imported']);
                }
                else {
                    return redirect()->back()->with(['error' => 'Invalid iteration selected']);
                }
            } else {
                return redirect()->back()->with(['error' => 'Invalid file format. Please upload an Excel file.']);
            }
        }
        return redirect()->back()->with(['error' => 'No file uploaded']);
    }
    public function deleteAllData(Request $request)
    {
        if ($request->iteration == 1) {
            $this->iterationOneGradeService->deleteAll();
            return redirect()->back()->with(['success' => 'Data successfully deleted']);
        }elseif ($request->iteration == 2) {
            $this->iterationTwoGradeService->deleteAll();
            return redirect()->back()->with(['success' => 'Data successfully deleted']);
        } elseif ($request->iteration == 3) {
            $this->iterationThreeGradeService->deleteAll();
            return redirect()->back()->with(['success' => 'Data successfully deleted']);
        }elseif($request->iteration == 'profile_kelulusan')
        {
            $this->profileKelulusanService->deleteAll();
            return redirect()->back()->with(['success' => 'Profile Kelulusan successfully deleted']);
        }
        else {
            return redirect()->back()->with(['error' => 'Invalid iteration selected']);
        }
    }

    public function iterationFinal()
    {
        $data = $this->iterationFinalGradeService->getAllProfiles();
        $profileKelulusan = $this->profileKelulusanService->profileData();

        return view('kmeans.iteration_final.index', compact('profileKelulusan', 'data'));

    }

    public function iterationFinalCreate()
    {
        $this->iterationFinalGradeService->createProfile();

        return redirect()->back()->with(['success' => 'Profile successfully created']);
    }

    public function profileKelulusan()
    {
        $title = 'Delete All Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $data = $this->profileKelulusanService->getAllProfiles();
        $profileKelulusan = $this->profileKelulusanService->profileData();

        return view('kmeans.profile_kelulusan.index', compact('data', 'profileKelulusan'));
    }

    public function profileKelulusanCreate()
    {
        $this->profileKelulusanService->createProfile();

        return redirect()->back()->with(['success' => 'Profile successfully created']);
    }

    public function checkProfileKelulusan(Request $request)
    {
        $result = $this->profileKelulusanService->checkProfileKelulusan($request);

        return response()->json([
            'status' => $result ? 'success' : 'error',
            'profile' => $result ? $result : '',
        ]);

    }


    public function authenticate(Request $request)
    {
        $auth = $this->authService->authenticate($request);
        if ($auth) {
            return redirect()->route('index')->with('success', 'Login Successful!');
        }else{
            return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'logged out successfully.');
    }

    public function resetPassword()
    {
        return view('auth.passwords.reset');
    }

    public function updatePassword(Request $request)
    {
        $this->authService->resetPassword($request);

        return redirect()->route('login')->with('success', 'Password successfully changed. Please login again.');
    }


}
