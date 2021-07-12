<?php

namespace App\Http\Controllers;

use App\DataTables\NewsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Repositories\NewsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\NewsLang;
use Illuminate\Http\Request;
use Response;

class NewsController extends AppBaseController
{
    /** @var  NewsRepository */
    private $newsRepository;

    public function __construct(NewsRepository $newsRepo)
    {
        $this->newsRepository = $newsRepo;
    }

    /**
     * Display a listing of the News.
     *
     * @param NewsDataTable $newsDataTable
     * @return Response
     */
    public function index(NewsDataTable $newsDataTable)
    {
        return $newsDataTable->render('news.index');
    }

    /**
     * Show the form for creating a new News.
     *
     * @return Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created News in storage.
     *
     * @param CreateNewsRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $request->validate([
            'img' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'title_ar' => 'required',
            'title_en' => 'required',


        ]);
        $input = $request->all();
        $file = $request->file('img');
        if ($request->hasFile('img')) {
            $filename = time() . '.' . $file->getClientOriginalExtension();
            request()->img->move(public_path('/uploads/images/news'), $filename);
            $input['image'] = $filename;
        } else {
            \Session::flash('msg', 'e:يجب اختيار صورة  الخبر');
            return redirect('/news/create')->withInput();
        }

        $news = $this->newsRepository->create($input);

        $new_lan1 = NewsLang::create([
            'new_id' =>$news->id ,
            'lang_id' => '1',
            'title'    => $request['title_en'],
            'description'    => $request['description_en'],
         ]);
 
 
         $new_lan2 = NewsLang::create([
             'new_id' => $news->id,
             'lang_id' => '2',
             'title'    => $request['title_ar'],
             'description'    => $request['description_ar'],
             ]);


        Flash::success('تم اضافة خبر جديد بنجاح');

        return redirect(route('news.index'));
    }

    /**
     * Display the specified News.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $news = $this->newsRepository->find($id);

        
        if (empty($news)) {
            Flash::error('الخبر غير متوفر');

            return redirect(route('news.index'));
        }
        $newTitleAr = $news->langs->where('lang_id', '=', '2')->first()->title;
        $newTitleEn = $news->langs->where('lang_id', '=', '1')->first()->title;
        $newDescAr = $news->langs->where('lang_id', '=', '2')->first()->description;
        $newDescEn = $news->langs->where('lang_id', '=', '1')->first()->description;

       
        return view('news.show',compact('news', 'newTitleAr','newTitleEn','newDescAr','newDescEn'));
    }

    /**
     * Show the form for editing the specified News.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error('الخبر غير متوفر');

            return redirect(route('news.index'));
        }
        $newTitleAr = $news->langs->where('lang_id', '=', '2')->first()->title;
        $newTitleEn = $news->langs->where('lang_id', '=', '1')->first()->title;
        $newDescAr = $news->langs->where('lang_id', '=', '2')->first()->description;
        $newDescEn = $news->langs->where('lang_id', '=', '1')->first()->description;

       
        return view('news.edit',compact('news', 'newTitleAr','newTitleEn','newDescAr','newDescEn'));
    }

    /**
     * Update the specified News in storage.
     *
     * @param  int              $id
     * @param UpdateNewsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNewsRequest $request)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error('الخبر غير متوفر');

            return redirect(route('news.index'));
        }

        
        $oldimg = $news->image;
        $input = $request->all();
        $file = $request->file('img');
        if (!empty($file)) {
            $filename = time() . '.' . $file->getClientOriginalExtension();
            request()->img->move(public_path('/uploads/images/news'), $filename);
            $input['image'] = $filename;
        } else {
            $input['image'] = $oldimg;
        }

        if ($request->hasAny('description_en', 'title_en')) {
            $news_lan1 = NewsLang::where('new_id', '=', $news->id)->where('lang_id', '=', '1')->first();
            $news_lan1->update([
                'new_id' => $news->id,
                'lang_id' => '1',
                'title'    => $request['title_en'],
                'description' => $request['description_en'],
            ]);
        }

        if ($request->hasAny('description_ar', 'title_ar')) {
            $news_lan2 = NewsLang::where('new_id', '=', $news->id)->where('lang_id', '=', '2')->first();
            $news_lan2->update([
                'new_id' => $news->id,
                'lang_id' => '2',
                'title'    => $request['title_ar'],
                'description' => $request['description_ar'],
            ]);
        }
        $news = $this->newsRepository->update( $input, $id);

        Flash::success('تم التعديل على الخبر بنجاح');

        return redirect(route('news.index'));
    }

    /**
     * Remove the specified News from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error('الخبر غير متوفر');

            return redirect(route('news.index'));
        }

        $this->newsRepository->delete($id);

        Flash::success('تم حذف الخبر بنجاح ');

        return redirect(route('news.index'));
    }
}
