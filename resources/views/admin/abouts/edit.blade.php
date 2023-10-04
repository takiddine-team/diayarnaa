@extends('admin.layouts.app')

@section('admin_css')
    <link href="{{ asset('dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_files/assets/css/sleek.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            {{-- ============================================== --}}
            {{-- ================== Header ==================== --}}
            {{-- ============================================== --}}
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div class="col-md-12">
                    <h1>تعديل</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.abouts-index') }}">
                                    <i class="fas fa-users-cog"></i> قائمة من نحن
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">تعديل</li>
                        </ol>
                    </nav>
                </div>




                <div class="content-wrapper">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-default">
                                    <div class="card-header justify-content-between " style="background-color: #4c84ff;">
                                    </div>
                                    <div class="card-body">
                                        <form
                                            action="{{ route('super_admin.abouts-update', isset($about->id) ? $about->id : -1) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">

                                                {{-- وصف من نحن بالإنجليزي --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="about_description_en">
                                                        وصف من نحن بالإنجليزي <strong class="text-danger"> *
                                                            @error('about_description_en')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="about_description_en" class="form-control ckeditor" rows="5"
                                                            id='about_description_en'>{{ isset($about->about_description_en) ? $about->about_description_en : 'Jawabmed was started out frustration with the current education system in the Arab world . The average medical student in the Arab world spends a significant amount of time sourcing information to use for studying and revising . This usually comes in the form of dense textbooks or scattered lecture notes and slides .' }}</textarea>
                                                    </div>
                                                </div>
                                                {{--  الوصف بالعربي --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="about_description_ar">
                                                        وصف من نحن بالعربي <strong class="text-danger"> *
                                                            @error('about_description_ar')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="about_description_ar" class="form-control ckeditor" rows="5"
                                                            id='about_description_ar'>{{ isset($about->about_description_ar) ? $about->about_description_ar : 'Jawabmed was started out frustration with the current education system in the Arab world . The average medical student in the Arab world spends a significant amount of time sourcing information to use for studying and revising . This usually comes in the form of dense textbooks or scattered lecture notes and slides .' }}</textarea>
                                                    </div>
                                                </div>

                                                {{-- About Image --}}
                                                <div class="col-md-6">
                                                    <h3 class="mb-3" for="validationServer01">صورة من نحن: :</h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="about_image" class="form-control"
                                                            id="about_image" placeholder="about_image">
                                                    </div>
                                                    @if (isset($about->about_image) &&
                                                        $about->getRawOriginal('about_image') &&
                                                        file_exists($about->getRawOriginal('about_image')))
                                                        <img src="{{ asset($about->about_image) }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif


                                                    @error('about_image')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>


                                                {{-- رسالتنا بالإنجليزي --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="our_message_en">
                                                        رسالتنا بالإنجليزي <strong class="text-danger"> *
                                                            @error('our_message_en')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="our_message_en" class="form-control ckeditor" rows="5"
                                                            id='our_message_en'>{{ isset($about->our_message_en) ? $about->our_message_en : 'Jawabmed was started out frustration with the current education system in the Arab world . The average medical student in the Arab world spends a significant amount of time sourcing information to use for studying and revising . This usually comes in the form of dense textbooks or scattered lecture notes and slides .' }}</textarea>
                                                    </div>
                                                </div>

                                                {{-- رسالتنا بالعربي --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="our_message_ar">
                                                        رسالتنا بالعربي <strong class="text-danger"> *
                                                            @error('our_message_ar')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="our_message_ar" class="form-control ckeditor" rows="5"
                                                            id='our_message_ar'>{{ isset($about->our_message_ar) ? $about->our_message_ar : 'Jawabmed was started out frustration with the current education system in the Arab world . The average medical student in the Arab world spends a significant amount of time sourcing information to use for studying and revising . This usually comes in the form of dense textbooks or scattered lecture notes and slides .' }}</textarea>
                                                    </div>
                                                </div>

                                                {{-- صورة رساالتنا --}}
                                                <div class="col-md-6">
                                                    <h3 class="mb-3" for="our_message_image">صورة رسالتنا</h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="our_message_image"
                                                            class="form-control" id="our_message_image"
                                                            placeholder="our_message_image">
                                                    </div>
                                                    @if (isset($about->our_message_image) &&
                                                        $about->getRawOriginal('our_message_image') &&
                                                        file_exists($about->getRawOriginal('our_message_image')))
                                                        <img src="{{ asset($about->our_message_image) }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif


                                                    @error('our_message_image')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>

                                                {{-- رؤيتنا EN --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="our_vission_en">
                                                        رؤيتنا بالانجليزي<strong class="text-danger"> *
                                                            @error('our_vission_en')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="our_vission_en" class="form-control ckeditor" rows="5"
                                                            id='our_vission_en'>{{ isset($about->our_vission_en) ? $about->our_vission_en : 'Jawabmed was started out frustration with the current education system in the Arab world . The average medical student in the Arab world spends a significant amount of time sourcing information to use for studying and revising . This usually comes in the form of dense textbooks or scattered lecture notes and slides .' }}</textarea>
                                                    </div>
                                                </div>

                                                {{-- رؤيتنا بالعربي --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="our_vission_ar">
                                                        رؤيتنا بالعربي <strong class="text-danger"> *
                                                            @error('our_vission_ar')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="our_vission_ar" class="form-control ckeditor" rows="5"
                                                            id='our_vission_ar'>{{ isset($about->our_vission_ar) ? $about->our_vission_ar : 'Jawabmed was started out frustration with the current education system in the Arab world . The average medical student in the Arab world spends a significant amount of time sourcing information to use for studying and revising . This usually comes in the form of dense textbooks or scattered lecture notes and slides .' }}</textarea>
                                                    </div>
                                                </div>

                                                {{-- رؤيتنا Image --}}
                                                <div class="col-md-6">
                                                    <h3 class="mb-3" for="our_vission_image">صورة رؤيتنا</h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="our_vission_image"
                                                            class="form-control" id="our_vission_image"
                                                            placeholder="our_vission_image">
                                                    </div>
                                                    @if (isset($about->our_vission_image) &&
                                                        $about->getRawOriginal('our_vission_image') &&
                                                        file_exists($about->getRawOriginal('our_vission_image')))
                                                        <img src="{{ asset($about->our_vission_image) }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif


                                                    @error('our_vission_image')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>

                                                {{-- قيمنا EN --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="our_value_en">
                                                        قيمنا بالإنجليزي <strong class="text-danger"> *
                                                            @error('our_value_en')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="our_value_en" class="form-control ckeditor" rows="5"
                                                            id='our_value_en'>{{ isset($about->our_value_en) ? $about->our_value_en : 'Jawabmed was started out frustration with the current education system in the Arab world . The average medical student in the Arab world spends a significant amount of time sourcing information to use for studying and revising . This usually comes in the form of dense textbooks or scattered lecture notes and slides .' }}</textarea>
                                                    </div>
                                                </div>

                                                {{-- قيمنا بالعربي --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="our_value_ar">
                                                        قيمنا بالعربي: <strong class="text-danger"> *
                                                            @error('our_value_ar')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="our_value_ar" class="form-control ckeditor" rows="5"
                                                            id='our_value_ar'>{{ isset($about->our_value_ar) ? $about->our_value_ar : 'Jawabmed was started out frustration with the current education system in the Arab world . The average medical student in the Arab world spends a significant amount of time sourcing information to use for studying and revising . This usually comes in the form of dense textbooks or scattered lecture notes and slides .' }}</textarea>
                                                    </div>
                                                </div>

                                                {{-- قيمنا Image --}}
                                                <div class="col-md-6">
                                                    <h3 class="mb-3" for="our_value_image">صورة قيمنا  :</h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="our_value_image" class="form-control"
                                                            id="our_value_image" placeholder="our_value_image">
                                                    </div>
                                                    @if (isset($about->our_value_image) &&
                                                        $about->getRawOriginal('our_value_image') &&
                                                        file_exists($about->getRawOriginal('our_value_image')))
                                                        <img src="{{ asset($about->our_value_image) }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif


                                                    @error('our_value_image')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>

                                                {{--  خلفية من نحن   --}}
                                                <div class="col-md-6">
                                                    <h3 class="mb-3" for="background_aboutus_image">صورة خلفية من نحن  :</h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="background_aboutus_image" class="form-control"
                                                            id="background_aboutus_image" placeholder="background_aboutus_image">
                                                    </div>
                                                    @if (isset($about->background_aboutus_image) &&
                                                        $about->getRawOriginal('background_aboutus_image') &&
                                                        file_exists($about->getRawOriginal('background_aboutus_image')))
                                                        <img src="{{ asset($about->background_aboutus_image) }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif


                                                    @error('background_aboutus_image')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>


                                                {{--  خلفية عن الشركة     --}}
                                                <div class="col-md-6">
                                                    <h3 class="mb-3" for="background_company_image">صورة خلفية عن الشركة  :</h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="background_company_image" class="form-control"
                                                            id="background_company_image" placeholder="background_company_image">
                                                    </div>
                                                    @if (isset($about->background_company_image) &&
                                                        $about->getRawOriginal('background_company_image') &&
                                                        file_exists($about->getRawOriginal('background_company_image')))
                                                        <img src="{{ asset($about->background_company_image) }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif


                                                    @error('background_company_image')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>




                                            </div>
                                            <button class="btn btn-primary" type="submit">حفظ التعديلات</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
