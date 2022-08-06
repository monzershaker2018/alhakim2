@extends('layouts.master')
@section('title')
لوحة التحكم - الطلاب

@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> الطلاب </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/عرض
                    الطلاب </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
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

            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0"> الطلاب</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <a class="modal-effect btn btn-primary btn-block" data-effect="effect-flip-horizontal"
                        data-toggle="modal" href="#modaldemo1"><i class="fa fa-plus"></i> اضافة طالب جديد</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">  اسم الطالب</th>
                                    <th class="border-bottom-0">  السكن </th>
                                    <th class="border-bottom-0">  رقم ولي الأمر </th>

                                    <th class="border-bottom-0">  المسنوى الدراسي </th>
                                    <th class="border-bottom-0">  الرسوم المدفوعة </th>
                                    <th class="border-bottom-0">  الرسوم المتبقية </th>
                                    <th class="border-bottom-0">   الحلقة </th>
                                    <th class="border-bottom-0">  العمليات</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{$student -> name}}</td>
                                        <td>{{$student -> address}}</td>
                                        <td>{{$student -> father_num}}</td>
                                        <td>{{$student -> year}}</td>
                                        <td>{{$student -> paid}}</td>
                                        <td>{{$student -> not_paid}}</td>
                                        <td>{{$student -> Halaqat -> name}}</td>

                                        <td>

                                            <a  class="modal-effect btn btn-sm btn-info"  data-effect="effect-scale"
                                            data-toggle="modal" href="#edit{{ $student->id }}"  title="تعديل"><i class="fa fa-edit"> </i> تعديل </a>

                                            <a  class="modal-effect btn btn-sm btn-danger"  data-effect="effect-scale"
                                            data-toggle="modal" href="#delete{{ $student->id }}"  title="حذف"><i class="fa fa-trash"> </i> حذف </a>


                                        </td>
                                    </tr>


<!-- Modal edit effects -->
<div class="modal" id="edit{{ $student->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل  الطالب </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                   {{-- فورم تعديل اسم الطالب --}}
                <form method="post" action="students/update" enctype="multipart/form-data" autocomplete="off">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="{{ $student->id }}">
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">إسم  الطالب</label>
                                <input type="text" class="form-control" id="name" name="name" required value="{{ $student->name }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">    السكن</label>
                                    <input type="text" class="form-control" name="address" required value="{{ $student->address }}">
                                </div>
                            </div>
                        </div>
                    </div>





                    <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">  رقم ولي الأمر</label>
                                    <input type="text" class="form-control" name="father_num" required  value="{{ $student->father_num }}">
                                </div>
                            </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">  المستوى الدراسي</label>
                                <select name="year" class="form-control" required>
                                    <option  value="{{ $student->year }}" selected disabled> {{ $student->year }} </option>
                                <option value="الأول أساس"> الأول أساس</option>
                                <option value="الثاني أساس"> الثاني أساس</option>
                                <option value="الثالث أساس"> الثالث أساس</option>
                                <option value="الرابع أساس"> الرابع أساس</option>
                                <option value="الخامس أساس"> الخامس أساس</option>
                                <option value="السادس أساس"> السادس أساس</option>
                                <option value="السابع أساس"> السابع أساس</option>
                                <option value="الثامن أساس"> الثامن أساس</option>

                                {{--  --}}
                                <option value="الأول ثانوي"> الأول ثانوي</option>
                                <option value="الثاني ثانوي"> الثاني ثانوي</option>
                                <option value="الثالث ثانوي"> الثالث ثانوي</option>
                            </select>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">  الرسوم المدفوعة</label>
                                <input type="text" class="form-control" name="paid" required  value="{{ $student->paid }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">  الرسوم المتبقية</label>
                                <input type="text" class="form-control" name="not_paid" required value="{{ $student->not_paid }}">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> الحلقة </label>
                                <select name="halaqa_id" class="form-control" required>
                                <option value="{{ $student-> Halaqat -> id }}" selected disabled>{{ $student-> Halaqat -> name }}</option>

                                @foreach ($halaqats as $halaqa)
                                 <option value="{{$halaqa->id}}"> {{$halaqa->name}}</option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                    </div>






            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="submit">تعديل </button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
            </div>
        </form>
        </div>
    </div>
</div><!-- End edit Modal effects-->


<!-- Modal delete effects -->
<div class="modal" id="delete{{ $student->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف  الطالب </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{-- فورم حذف رحله --}}
                <form method="post" action="students/destory">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <input type="text" name="id" id="id" value="{{ $student->id }}"  class="form-control" hidden>
                <div class="form-group">
                    <label for="">هل تريد حذف  الطالب ؟</label>
                    <input type="text" name="name" id="name"  value="{{ $student->name }}" class="form-control" readonly>
                </div>


            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="submit">تاكيد </button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
            </div>
        </form>
        </div>
    </div>
</div><!-- End edit Modal effects-->


                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div> <!-- row closed -->

    <!-- create Modal effects -->
    <div class="modal" id="modaldemo1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"> إضافة  حلقه</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    {{-- فورم اضافه دوره جديده --}}
                    <form method="post" action=" {{ route('students.store') }} " enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">إسم  الطالب</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">    السكن</label>
                                        <input type="text" class="form-control" name="address" required>
                                    </div>
                                </div>
                            </div>
                        </div>





                        <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">  رقم ولي الأمر</label>
                                        <input type="text" class="form-control" name="father_num" required>
                                    </div>
                                </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">  المستوى الدراسي</label>
                                    <select name="year" class="form-control" required>
                                        <option value="" selected disabled> -- أختر المستوى --</option>
                                    <option value="الأول أساس"> الأول أساس</option>
                                    <option value="الثاني أساس"> الثاني أساس</option>
                                    <option value="الثالث أساس"> الثالث أساس</option>
                                    <option value="الرابع أساس"> الرابع أساس</option>
                                    <option value="الخامس أساس"> الخامس أساس</option>
                                    <option value="السادس أساس"> السادس أساس</option>
                                    <option value="السابع أساس"> السابع أساس</option>
                                    <option value="الثامن أساس"> الثامن أساس</option>

                                    {{--  --}}
                                    <option value="الأول ثانوي"> الأول ثانوي</option>
                                    <option value="الثاني ثانوي"> الثاني ثانوي</option>
                                    <option value="الثالث ثانوي"> الثالث ثانوي</option>
                                </select>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">  الرسوم المدفوعة</label>
                                    <input type="text" class="form-control" name="paid" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">  الرسوم المتبقية</label>
                                    <input type="text" class="form-control" name="not_paid" required>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> الحلقة </label>
                                    <select name="halaqa_id" class="form-control" required>
                                    <option value="" selected disabled> -- أختر الحلقة --</option>

                                    @foreach ($halaqats as $halaqa)
                                     <option value="{{$halaqa->id}}"> {{$halaqa->name}}</option>
                                    @endforeach
                                </select>

                                </div>
                            </div>
                        </div>






                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End Modal effects-->



    </div> <!-- Container closed -->

    </div> <!-- main-content closed -->

@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
@endsection
