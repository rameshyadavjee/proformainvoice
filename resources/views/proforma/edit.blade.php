@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Update Status</div>

                <div class="card-body">
                    <form action="{{ route('proforma.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label><strong> Name</strong></label>
                                <input type="text" name="business_name" id="business_name" value="{{ old('business_name', $item->business_name ?? '') }}" class="form-control">
                            </div>
                            <div class="form-group col-md-8">
                                <label><strong>Remarks</strong></label>
                                <textarea name="remarks" id="remarks" class="form-control">{{ old('remarks', $item->remarks ?? '') }}</textarea>
                                @error('remarks')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label><strong>Status</strong></label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="" disabled>Select status</option>
                                    <option value="Open" {{ (old('status', $item->status) == 'Open') ? 'selected' : '' }}>Open</option>
                                    <option value="Close" {{ (old('status', $item->status) == 'Close') ? 'selected' : '' }}>Close</option>
                                    <option value="Cancel" {{ (old('status', $item->status) == 'Cancel') ? 'selected' : '' }}>Cancel</option>
                                </select>

                            </div>
                            <div class="form-group col-md-3 mt-4">
                                <button type="submit" class="btn btn-success btn-lg">{{ 'Save' }}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection