@extends('Admin.layouts.admin')
@section('style')
	<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="row justify-content-between px-3">
							<span class="my-auto">
								Exam Detail
							</span>
						</div>
					</div>
					<div class="card-body">
						<form id="form">
							<div class="form-row">
								<div class="col">
									<div class="form-group">
										<label for="">Exam ID</label>
									<input type="text" class="form-control" value="{{$exam->id}}" readonly>
									</div>
									<div class="form-group">
										<label for="">Semester</label>
										<input type="text" class="form-control"  value="{{$exam->semester}}" readonly>
									</div>
									<div class="form-group">
										<label for="">Classroom</label>
										<input type="text" class="form-control"  value="{{$exam->classroom}}" readonly>
									</div>
									<div class="form-group">
										<label for="">Start At</label>
										<input type="text" class="form-control" value="{{$exam->start_at}}" readonly>
									</div>
									<div class="form-group">
										<label for="">Duration</label>
										<input type="text" class="form-control" value="{{$exam->duration}}" readonly>
                                    </div>
                                    <div class="form-group">
										<label for="">Status</label>
										<input type="text" class="form-control" value="{{$exam->status}}" readonly>
									</div>
								</div>
								<div class="col exam-question" style="max-height: 500px;
                                                                        overflow-y: scroll;
                                                                        margin-bottom: 2em;">
									<div class="form-row justify-content-center">
										<label for="">Question List</label>
                                    </div>
                                    <div class="form-group">
                                        <table class="table" >
                                            <thead>
                                                <tr>
                                                    <th class="w-10">#</th>
                                                    <th class="w-60">Question</th>
                                                    <th class="w-40 text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                <?php $i = 0;?>
                                                @foreach ($questions as $question)
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td>{{$question}}</td>
                                                        <td class="text-right">
                                                            <a class="btn detail-button">Detail</a>
                                                            <a class="btn create-button">Remove</a>
                                                        </td>
                                                    </tr>
                                                    <?php $i++;?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
								</div>
							</div>
							<div class="form-group">
                                <button type="button" id="editButton" class="btn detail-button btn-block">Edit</button>
                                <button type="submit" id="updateButton" class="btn detail-button btn-block mt-0">Update</button>
								<button type="button" class="btn create-button btn-block">Delete this Exam</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
    @section('script')
        <script type="text/javascript">
            $(document).ready(function(){
                $('#updateButton').hide();
                $('#editButton').on('click', function(){
                    $(this).hide();
                    $('#updateButton').toggle();
                    $('input[type=text]').prop('readonly', false);
                });
            });
        </script>
    @endsection
 @endsection
