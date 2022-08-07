<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\StoreDocumentVideoRequest;
use App\Http\Requests\UpdateDocumentRequest;
use DB;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function documentVideo(Request $request)
    {
        $documents = Document::where('type', 1);

        if ($request->search) {
            $documents = $documents->where('name', 'like', '%'.$request->search.'%');
        }
        $documents = $documents->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'documents' => $documents
        ];

        return view('document.document-video', $data);
    }

    public function documentRead(Request $request)
    {
        $documents = Document::where('type', 2);

        if ($request->search) {
            $documents = $documents->where('name', 'like', '%'.$request->search.'%');
        }
        $documents = $documents->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'documents' => $documents
        ];

        return view('document.document-read', $data);
    }

    public function documentEnglish(Request $request)
    {
        $documents = Document::where('type', 3);

        if ($request->search) {
            $documents = $documents->where('name', 'like', '%'.$request->search.'%');
        }
        $documents = $documents->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'documents' => $documents
        ];

        return view('document.document-english', $data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = [
            'route' => $request->route,
            'type' => $request->type,
        ];

        return view('document.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $file_path_image = '';
            if ($request->file('image')) {
                $name = time().'_'.$request->image->getClientOriginalName();
                $file_path_image = 'uploads/document/image/'.$name;
                Storage::disk('public_uploads')->putFileAs('document/image', $request->image, $name);
            }

            $file_path_file = '';
            if ($request->file('file')) {
                $name = time().'_'.$request->file->getClientOriginalName();
                $file_path_file = 'uploads/document/file/'.$name;
                Storage::disk('public_uploads')->putFileAs('document/file', $request->file, $name);
            }

            $create = Document::create([
                'type' => $request->type,
                'name' => $request->name,
                'image' => $file_path_image,
                'file' => $file_path_file,
            ]);
            
            DB::commit();
            return redirect()->route($request->route)->with('alert-success','Thêm tài liệu thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm tài liệu thất bại!');
        }
    }

    public function storeVideo(StoreDocumentVideoRequest $request)
    {
        try {
            DB::beginTransaction();

            $file_path_file = '';
            if ($request->file('file')) {
                $name = time().'_'.$request->file->getClientOriginalName();
                $file_path_file = 'uploads/document/file/'.$name;
                Storage::disk('public_uploads')->putFileAs('document/file', $request->file, $name);
            }

            $create = Document::create([
                'type' => $request->type,
                'name' => $request->name,
                'file' => $file_path_file,
            ]);
            
            DB::commit();
            return redirect()->route($request->route)->with('alert-success','Thêm tài liệu thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm tài liệu thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        $data = [
            'document' => $document,
        ];
        
        return view('document.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Document $document)
    {
        $data = [
            'route' => $request->route,
            'type' => $request->type,
            'data_edit' => $document,
        ];

        return view('document.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        try {
            DB::beginTransaction();

            $data = [
                'name' => $request->name,
            ];
            
            if ($request->file('image')) {
                $name = time().'_'.$request->image->getClientOriginalName();
                $file_path_image = 'uploads/document/image/'.$name;
                Storage::disk('public_uploads')->putFileAs('document/image', $request->image, $name);
                $data['image'] = $file_path_image;
            }

            if ($request->file('file')) {
                $name = time().'_'.$request->file->getClientOriginalName();
                $file_path_file = 'uploads/document/file/'.$name;
                Storage::disk('public_uploads')->putFileAs('document/file', $request->file, $name);
                $data['file'] = $file_path_file;
            }

            $document->update($data);
            
            DB::commit();
            return redirect()->route($request->route)->with('alert-success','Sửa tài liệu thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa tài liệu thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        try {
            DB::beginTransaction();

            $document->destroy($document->id);
            
            DB::commit();
            return redirect()->back()->with('alert-success','Xóa tài liệu thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa tài liệu thất bại!');
        }
    }
}
