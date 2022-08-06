@extends('layouts.front.master')
@section('css')

<style>
    body {
    background-color: #19123B
}

.card {
    border: none;
    border-top: 5px solid rgb(176, 106, 252);
    background: #212042;
    color: #57557A
}

p {
    font-weight: 600;
    font-size: 15px
}

.fab {
    display: flex;
    justify-content: center;
    align-items: center;
    border: none;
    background: #2A284D;
    height: 40px;
    width: 90px
}

.fab:hover {
    cursor: pointer
}



.division {
    float: none;
    position: relative;
    margin: 30px auto 20px;
    text-align: center;
    width: 100%;
    box-sizing: border-box
}

.division .line {
    border-top: 1.5px solid #57557A;
    ;
    position: absolute;
    top: 13px;
    width: 85%
}



.division span {
    font-weight: 600;
    font-size: 14px
}

.myform {
    padding: 0 25px 0 33px
}

.form-control {
    border: 1px solid #57557A;
    border-radius: 3px;
    background: #212042;
    margin-bottom: 20px;
    letter-spacing: 1px
}

.form-control:focus {
    border: 1px solid #57557A;
    border-radius: 3px;
    box-shadow: none;
    background: #212042;
    color: #fff;
    letter-spacing: 1px
}

.bn {
    text-decoration: underline
}

.bn:hover {
    cursor: pointer
}

.form-check-input {
    margin-top: 8px !important
}

.btn-primary {
    background: linear-gradient(135deg, rgba(176, 106, 252, 1) 39%, rgba(116, 17, 255, 1) 101%);
    border: none;
    border-radius: 50px
}

.btn-primary:focus {
    box-shadow: none;
    border: none
}

small {
    color: #F2CEFF
}

.far.fa-user {
    font-size: 13px
}

@media(min-width: 767px) {
    .bn {
        text-align: right
    }
}

@media(max-width: 767px) {
    .form-check {
        text-align: center
    }

    .bn {
        text-align: center;
        align-items: center
    }
}

@media(max-width: 450px) {
    .fab {
        width: 100%;
        height: 100%
    }

    .division .line {
        width: 50%
    }
}
</style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  تغيير كلمة المرور </span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">


                    <div class="container">
                         {{-- عرض الاخطاء --}}
 @if ($errors->any())
 <div class="alert alert-danger">
     <ul>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </ul>
 </div>
@endif
                        <div class="row d-flex justify-content-center mt-5">
                            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                                <div class="card py-3 px-2">

                                    <div class="division">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="line l"></div>
                                            </div>
                                            <div class="col-6"><span> تغيير كلمة المرور </span></div>
                                            <div class="col-3">
                                                <div class="line r"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <form class="myform" method="POST" action="{{ route('change') }}">
                                        @csrf

                                        <div class="form-group"> <input type="password" class="form-control" placeholder="كلمة المرور القديمة   " @error('current_password') is-invalid @enderror name="current_password" required autocomplete="current_password">
                                            @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>

                                        <div class="form-group"> <input type="password" class="form-control" placeholder="كلمة المرور الجديدة  " @error('new_password') is-invalid @enderror name="new_password" required autocomplete="new_password">
                                            @error('new_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>

                                        <div class="form-group"> <input type="password" class="form-control" placeholder="تأكيد كلمة المرور الجديدة   " @error('new_confirm_password') is-invalid @enderror name="new_confirm_password" required autocomplete="new_confirm_password">
                                            @error('new_confirm_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                        <div class="form-group mt-3">
                                             <button type="submit" class="btn btn-block btn-primary btn-lg"><small>  تغيير </small></button>
                                             </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>




				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
