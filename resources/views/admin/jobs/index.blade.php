@extends('essentials.admin_navbar')
@section('title', 'Jobs')
@section('crumb', 'Jobs')

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">Jobs</h1>
        <p class="adm-page-sub">{{ $jobs->total() }} listing{{ $jobs->total() === 1 ? '' : 's' }} in total.</p>
    </div>
    <div class="adm-page-actions">
        <a href="{{ route('admin.jobs.create') }}" class="adm-btn is-primary"><i class="ri-add-line"></i> Add job</a>
    </div>
</div>

@if(session('success'))
    <div class="adm-alert is-success">
        <span class="adm-alert-title"><i class="ri-check-line"></i> {{ session('success') }}</span>
    </div>
@endif

<div class="adm-card">
    <div class="adm-card-body is-flush">
        @if($jobs->count())
        <div class="adm-table-wrap">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th class="is-tight">Image</th>
                        <th>Role</th>
                        <th>Destination</th>
                        <th class="is-num">Positions</th>
                        <th class="is-tight">Featured</th>
                        <th class="is-tight">Posted</th>
                        <th class="is-tight"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                    <tr>
                        <td class="is-tight">
                            @if($job->image_path)
                                <img src="{{ asset('storage/' . $job->image_path) }}" alt="" class="adm-thumb">
                            @else
                                <span class="adm-thumb-empty"><i class="ri-image-line"></i></span>
                            @endif
                        </td>
                        <td>
                            <span class="adm-cell-title">{{ $job->title }}</span>
                            <span class="adm-cell-sub">
                                @if($job->title_ja){{ $job->title_ja }} · @endif
                                {{ \Str::limit(strip_tags($job->description), 90) }}
                            </span>
                        </td>
                        <td>{{ $job->country }}</td>
                        <td class="is-num">{{ $job->positions_left }}</td>
                        <td class="is-tight">
                            <span class="adm-pill {{ $job->is_featured ? 'is-on' : 'is-off' }}">
                                {{ $job->is_featured ? 'Featured #' . ($job->featured_order ?? '—') : 'Standard' }}
                            </span>
                        </td>
                        <td class="is-tight adm-num">
                            {{ $job->posted_on ? $job->posted_on->format('Y-m-d') : '—' }}
                        </td>
                        <td class="is-tight">
                            <div class="adm-row-actions">
                                <a href="{{ route('admin.jobs.edit', $job) }}" class="adm-btn is-sm">
                                    <i class="ri-edit-line"></i> Edit
                                </a>
                                <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this job?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="adm-btn is-sm is-danger">
                                        <i class="ri-delete-bin-line"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="adm-empty">
            <i class="ri-briefcase-4-line"></i>
            <span class="adm-empty-title">No jobs available</span>
            <a href="{{ route('admin.jobs.create') }}" class="adm-btn is-primary is-sm">Add the first job</a>
        </div>
        @endif
    </div>

    {{ $jobs->links('admin.partials.pagination') }}
</div>
@endsection
