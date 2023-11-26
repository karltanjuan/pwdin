@extends('admin.layouts.master')

@php $page_title = "Employers Monitoring"; @endphp
@section('title', 'Admin - '.$page_title)

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-5">{{$page_title}}</h1>
    
    <div class="row mb-5">
        <div class="col-md-12">
            <table class="table table-bordered table-striped employers-table" id="employers-table">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Contact Person</th>
                        <th>Mobile Number</th>
                        <th>Address</th>
                        <th>Registered</th>
                        <th>Approved</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($employers) > 0)
                        @foreach ($employers as $employer)
                        <tr>
                            <td>{{ $employer->company_name }}</td>
                            <td>{{ $employer->contact_person }}</td>
                            <td>{{ $employer->mobile_no }}</td>
                            <td>{{ $employer->city }} {{ $employer->province }}</td>
                            <td>{{ date('m/d/y', strtotime($employer->created_at))}}</td>
                            <td>{{ date('m/d/y', strtotime($employer->updated_at))}}</td>
                            <td>
                                @if($employer->status == 0)
                                    <span class="badge bg-secondary">Pending</span>
                                @elseif($employer->status == 1)
                                    <span class="badge bg-success">Approved</span>
                                @elseif($employer->status == 2)
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-outline-secondary btn-view btn-sm" id="btn-view" data-id="{{ $employer->id }}">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-center">No records found.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade viewModal" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">View Employer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
            
        </div>
      </div>
    </div>
  </div>

<script>
    window.addEventListener('DOMContentLoaded', event => {
        const datatablesSimple = document.getElementById('employers-table');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    });

    let id = 0;
    $(document).on('click', '.btn-view', function() {
        id = $(this).data('id')
        getEmployerById(id)
        $('#viewModal').modal('show')
    })

    function getEmployerById(id) {
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('id', parseInt(id));

        $.ajax({
            url: '{{ route('admin.getEmployerById') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var employer   = response

                var company_logo = employer.company_logo.replace('public', 'storage')
                var business_permit = employer.business_permit.replace('public', 'storage')
                var bir_certificate = employer.bir_certificate.replace('public', 'storage')

                $('#viewModal .modal-body').html(`
                    <div class="mx-auto text-center mb-3">
                        <p>Company Logo:</p> <img style="border: 1px solid #333;border-radius:50%;" class="img-fluid" src='{{asset('${company_logo}')}}' alt='Company Logo'/>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">Company Name: ${employer.company_name}</li>
                        <li class="list-group-item">Contact Person: ${employer.contact_person}</li>
                        <li class="list-group-item">Summary: ${employer.summary}</div>
                        <li class="list-group-item">Business Permit: <a href='{{asset('${business_permit}')}}' target='_blank'>View and Download</a></div>
                        <li class="list-group-item">BIR Certificate: <a href='{{asset('${bir_certificate}')}}' target='_blank'>View and Download</a></li>

                        <li class="list-group-item">Mobile Number: ${employer.mobile_no}</li>
                        <li class="list-group-item">Email Address: ${employer.email}</li>
                        <li class="list-group-item"> Date Registered: ${moment(employer.created_at).format('LLL')}</li>
                        <li class="list-group-item">Date Approved: ${moment(employer.updated_at).format('LLL')}</li>
                        <li class="list-group-item">Full Address: ${employer.address}, ${employer.city}, ${employer.province}, ${employer.zip_code}</li>
                    </ul>
                    <label class="mt-3" for="status">Update Status:</label>
                    <div class="input-group">
                        <select class="form-select status" id="status" data-id="${employer.id}"></select>
                        <button type="button" class="btn-update btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Update</button>
                    </div>
                `)

                var pendingSelected = "";
                var approvedSelected = "";
                var rejectedSelected = "";

                if (employer.status == 0) {
                    pendingSelected = "selected";
                } else if (employer.status == 1) {
                    approvedSelected = "selected";
                } else if (employer.status == 2) {
                    rejectedSelected = "selected";
                }

                var html = "";

                html += `<option value="0" ${pendingSelected}>Pending</option>
                        <option value="1" ${approvedSelected}>Approved</option>
                        <option value="2" ${rejectedSelected}>Rejected</option>`;

                $('.status').html(html)


            },
            error: function(xhr, status, error) {
                var result = JSON.parse(xhr.responseText)
                console.log(result.errors)
            }
        });
    }

    let click_counter = 0;

    $(document).on('click', '.btn-update', function() {
        $(this).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`);

        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('id', id);
        formData.append('status', $('.status').val());

        if (click_counter === 0) {
                click_counter++;
                $(this).prop('disabled', true);

            $.ajax({
                url: '{{ route('admin.updateEmployerApproval') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                        $('.btn-update').html(`Update`);
                        $('.modal').hide()

                        toastr.success('Employer Status Updated', 'Success')

                        setTimeout(function() {
                            window.location.href = '{{url('admin/employers')}}'
                        }, 2000)
                    } else {
                        displayErrors(JSON.parse(response.errors));
                        $('.btn-update').html(`Update`).prop('disabled', false);
                        click_counter = 0;
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the AJAX request error
                    var result = JSON.parse(xhr.responseText)
                    displayErrors(result.errors)
                    $('.btn-update').html(`Update`).prop('disabled', false);
                    click_counter = 0;
                }
            });
        }
    })
</script>
@endsection
