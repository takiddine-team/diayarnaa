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
                    <h1> تعديل</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.contact_us-index') }}">
                                    <i class="fas fa-users-cog"></i> قائمة اتصل بنا
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
                                            action="{{ route('super_admin.contact_us-update', isset($contact->id) ? $contact->id : -1) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">

                                                {{-- Phone  --}}
                                                <div class="col-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="phone">
                                                        رقم الهاتف : <strong class="text-danger"> *
                                                            @error('phone')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <input type="phone" name="phone"
                                                            class="form-control @error('phone') is-invalid @enderror"
                                                            id="phone" placeholder="رقم الهاتف"
                                                            value="{!! $contact->phone
                                                                ? $contact->phone
                                                                : '+962 78 534 8081                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ' !!}">
                                                    </div>
                                                </div>

                                                {{-- Phone Two  --}}
                                                <div class="col-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="phone_two">
                                                        رقم هاتف بديل : <strong class="text-danger">
                                                            @error('phone_two')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <input type="phone" name="phone_two"
                                                            class="form-control @error('phone_two') is-invalid @enderror"
                                                            id="phone_two" placeholder="رقم هاتف بديل"
                                                            value="{!! $contact->phone_two
                                                                ? $contact->phone_two
                                                                : '+962 78 534 8081                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ' !!}">
                                                    </div>
                                                </div>
                                                {{-- Email AR --}}
                                                <div class="col-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="email">
                                                        البريد الالكتروني : <strong class="text-danger"> *
                                                            @error('email')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <input type="email" name="email" 
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            id="email" placeholder="البريد الالكتروني"
                                                            value="{!! $contact->email ? $contact->email : 'diyarnaa@gmail.com' !!}">
                                                    </div>
                                                </div>


                                                {{-- URL Map --}}
                                                <div class="col-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="url_map">
                                                        رابط الخريطة : <strong class="text-danger"> *
                                                            @error('url_map')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="url" name="url_map"
                                                            class="form-control @error('url_map') is-invalid @enderror"
                                                            id="url_map" placeholder="رابط الخريطة"
                                                            value="{!! $contact->url_map ? $contact->url_map : 'https://goo.gl/maps/iDcxrTTfS6yxju6s8' !!}">
                                                    </div>

                                                </div>



                                                {{-- Facebook --}}
                                                <div class="col-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="facebook">
                                                        رابط الفيسبوك : <strong class="text-danger"> *
                                                            @error('facebook')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="url" name="facebook"
                                                            class="form-control @error('facebook') is-invalid @enderror"
                                                            id="facebook" placeholder="فيسبوك"
                                                            value="{!! $contact->facebook
                                                                ? $contact->facebook
                                                                : 'https://www.facebook.com/                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ' !!}">
                                                    </div>

                                                </div>


                                                {{-- Instagram --}}
                                                <div class="col-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="instagram">
                                                        رابط الانستاغرام: <strong class="text-danger"> *
                                                            @error('instagram')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="url" name="instagram"
                                                            class="form-control @error('instagram') is-invalid @enderror"
                                                            id="instagram" placeholder="انستغرام"
                                                            value="{!! $contact->instagram
                                                                ? $contact->instagram
                                                                : "https://www.instagram.com/
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        " !!}">
                                                    </div>

                                                </div>

                                                {{-- رابط تويتر --}}
                                                <div class="col-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="twitter">
                                                        رابط تويتر : <strong class="text-danger"> *
                                                            @error('twitter')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="url" name="twitter"
                                                            class="form-control @error('twitter') is-invalid @enderror"
                                                            id="twitter" placeholder="رابط تويتر"
                                                            value="{!! $contact->twitter
                                                                ? $contact->twitter
                                                                : "https://www.twitter.com/
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        " !!}">
                                                    </div>

                                                </div>

                                                {{-- لينكد إن --}}
                                                <div class="col-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="linkedin">
                                                        لينكد إن : <strong class="text-danger"> *
                                                            @error('linkedin')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="url" name="linkedin"
                                                            class="form-control @error('linkedin') is-invalid @enderror"
                                                            id="linkedin" placeholder="لينكد إن"
                                                            value="{!! $contact->linkedin ? $contact->linkedin : 'https://www.linkedin.com/' !!}">
                                                    </div>

                                                </div>

                                                {{-- ماسنجر --}}
                                                <div class="col-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="messanger">
                                                        رابط الماسنجر : <strong class="text-danger"> *
                                                            @error('messanger')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="url" name="messanger"
                                                            class="form-control @error('messanger') is-invalid @enderror"
                                                            id="messanger" placeholder="ماسنجر"
                                                            value="{!! $contact->messanger ? $contact->messanger : 'https://www.messanger.com/' !!}">
                                                    </div>
                                                </div>
                                                {{-- يوتيوب --}}
                                                <div class="col-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="youtube">
                                                        رابط اليوتيوب : <strong class="text-danger"> *
                                                            @error('youtube')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="url" name="youtube"
                                                            class="form-control @error('youtube') is-invalid @enderror"
                                                            id="youtube" placeholder="اليوتيوب"
                                                            value="{!! $contact->youtube ? $contact->youtube : 'https://www.youtube.com/channel/UCSaoC5OYn_ufaydEC8eOScQ' !!}">
                                                    </div>

                                                </div>

                                                   {{--  خلفية  اتصل بنا   --}}
                                                <div class="col-md-6">
                                                    <h3 class="mb-3" for="background_image">صورة خلفية  اتصل بنا  :</h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="background_image" class="form-control"
                                                            id="background_image" placeholder="background_image">
                                                    </div>
                                                    @if (isset($contact->background_image) &&
                                                        $contact->getRawOriginal('background_image') &&
                                                        file_exists($contact->getRawOriginal('background_image')))
                                                        <img src="{{ asset($contact->background_image) }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif


                                                    @error('background_image')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>






                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary" type="submit">حفظ التعديلات</button>
                                            </div>
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
