@extends('layouts.app')

@section('title', 'Medical Records')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
    <div>
        <div class="section-line mb-4"></div>
        <p class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:rgba(0,48,47,0.4);">Secure patient records</p>
        <h1 class="font-bold tracking-tight" style="font-size:32px; letter-spacing:-1px; color:#00302f;">Medical Records</h1>
    </div>
    <a href="{{ route('medical-records.create') }}" class="pill-btn pill-btn-teal self-start">
        <i class="fas fa-plus mr-2 text-xs"></i> Add Record
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    @forelse($records as $record)
        @php
            $fileIcons = [
                'pdf' => 'fa-file-pdf',
                'lab_report' => 'fa-flask',
                'imaging' => 'fa-x-ray',
                'prescription' => 'fa-prescription',
                'discharge_summary' => 'fa-file-medical',
                'vaccination' => 'fa-syringe',
            ];
            $fileIcon = $fileIcons[$record->record_type] ?? 'fa-file-medical';
        @endphp
        <div class="editorial-card rounded-2xl overflow-hidden" style="background:white;">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(0,48,47,0.04);">
                            <i class="fas {{ $fileIcon }} text-xl" style="color:#00302f;"></i>
                        </div>
                        <div>
                            <p class="font-bold text-sm" style="color:#00302f;">{{ ucfirst(str_replace('_', ' ', $record->record_type)) }}</p>
                            <p class="text-xs" style="color:rgba(0,48,47,0.4);">{{ $record->record_date->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <span class="tag-pill">{{ ucfirst(str_replace('_', ' ', $record->visibility)) }}</span>
                </div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-cream-100 text-xs font-bold" style="background:#00302f;">
                        {{ strtoupper(substr($record->patient->user->name ?? 'P', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium" style="color:#00302f;">{{ $record->patient->user->name ?? 'Patient' }}</p>
                        <p class="text-xs" style="color:rgba(0,48,47,0.4);">Dr. {{ $record->doctor->user->name ?? 'Doctor' }}</p>
                    </div>
                </div>
                @if($record->description)
                    <p class="text-sm leading-relaxed line-clamp-2" style="color:rgba(0,48,47,0.5);">{{ Str::limit($record->description, 100) }}</p>
                @endif
                @if($record->file_path)
                    <div class="mt-4 flex items-center gap-2 p-3 rounded-xl border" style="background:rgba(0,48,47,0.02); border:1.5px solid rgba(0,48,47,0.12);">
                        <i class="fas fa-paperclip text-sm" style="color:rgba(0,48,47,0.4);"></i>
                        <span class="text-xs font-medium truncate flex-1" style="color:rgba(0,48,47,0.6);">{{ $record->file_name ?? 'Attachment' }}</span>
                        <a href="{{ route('medical-records.download', $record) }}" class="w-7 h-7 rounded-lg flex items-center justify-center border" style="background:white; border:1.5px solid rgba(0,48,47,0.15);">
                            <i class="fas fa-download text-xs" style="color:#00302f;"></i>
                        </a>
                    </div>
                @endif
            </div>
            <div class="px-6 py-4 flex items-center gap-2" style="border-top:1.5px solid rgba(0,48,47,0.1); background:rgba(0,48,47,0.02);">
                <a href="{{ route('medical-records.show', $record) }}" class="flex-1 py-2 rounded-lg text-xs font-semibold text-center transition-all border" style="background:white; border:1.5px solid rgba(0,48,47,0.15); color:#00302f;">View</a>
                <a href="{{ route('medical-records.edit', $record) }}" class="flex-1 py-2 rounded-lg text-xs font-semibold text-center transition-all border" style="background:white; border:1.5px solid rgba(0,48,47,0.15); color:#00302f;">Edit</a>
                <form action="{{ route('medical-records.destroy', $record) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-2 rounded-lg text-xs font-semibold text-center transition-all border" style="background:white; border:1.5px solid rgba(0,48,47,0.15); color:#00302f;">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-full py-16 text-center">
            <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 border-2" style="background:rgba(0,48,47,0.04); border-color:rgba(0,48,47,0.12);">
                <i class="fas fa-file-medical text-2xl" style="color:rgba(0,48,47,0.4);"></i>
            </div>
            <h3 class="text-lg font-semibold mb-1" style="color:#00302f;">No records yet</h3>
            <p class="text-sm mb-4" style="color:rgba(0,48,47,0.5);">Add your first medical record.</p>
            <a href="{{ route('medical-records.create') }}" class="pill-btn pill-btn-teal inline-flex">
                <i class="fas fa-plus mr-2 text-xs"></i> Add Record
            </a>
        </div>
    @endforelse
</div>

<div class="mt-8">
    {{ $records->links() }}
</div>
@endsection
