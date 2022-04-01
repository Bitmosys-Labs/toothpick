<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Job\Model\Job;
use App\Modules\Job_application\Model\Job_application;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CareerApiController extends Controller
{
    public function job()
    {
        $checkTime = Carbon::now()->format('Y-m-d');
        $jobs_disable = Job::whereDate('till', '<=', $checkTime)->get();
        foreach ($jobs_disable as $job){
            $data['status'] = 0;
            $job->update($data);
        }
        $jobs = Job::where('status', 1)->get();

        $response = [
            'success' => true,
            'message' => 'List of jobs',
            'result' => $jobs
        ];
        return response($response, 200);
    }

    public function jobApplication(Request $request)
    {
            $application = new Job_application();
            $job = Job::where('id', $request->id)->first();
            $data = [
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'no_of_days' => $request->no_of_days,
                'job_id' => $job->id,
                'drive' => $request->drive,
                'access_to_car' => $request->car,
                'postcode' => $request->post_code,

            ];
            if ($request->hasFile('cv')) {
                $file = $request->file('cv');
                $uploadPath = public_path('uploads/resume/');
                $data['cv'] = $this->fileUpload($file, $uploadPath);
            }
            if($application->create($data)){
                $response = [
                    'success' => true,
                    'message' => 'Application successfully submitted!',
                    'result' => null
                ];
                return response($response, 200);
            }
            else{
                $response = [
                    'success' => false,
                    'message' => 'Application submission failure!',
                    'result' => null
                ];
                return response($response, 400);
            }
    }

    public function fileUpload($file, $path){
        $ext = $file->getClientOriginalExtension();
        $imageName = md5(microtime()) . '.' . $ext;
        if (!$file->move($path, $imageName)) {
            return redirect()->back();
        }
        return $imageName;
    }
}
