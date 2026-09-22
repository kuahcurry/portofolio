@extends('layouts.admin')

@section('title', 'Skills & Capabilities')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-[#E8E5DC] pb-4">
        <div>
            <h1 class="font-serif text-3xl font-bold text-[#1C1917]">Languages, Frameworks &amp; Tools</h1>
            <p class="text-sm text-[#57534E] mt-1">
                Manage your technical competency stack, proficiency indices, and category groupings.
            </p>
        </div>
        <div>
            <a href="{{ route('admin.skills.create') }}" class="px-4 py-2.5 rounded-lg bg-[#1C1917] text-[#FAF9F6] text-xs font-mono font-medium hover:bg-[#322F2D] transition flex items-center gap-2 shadow-xs">
                <span class="material-symbols-outlined text-sm">add_circle</span>
                <span>Add New Skill</span>
            </a>
        </div>
    </div>

    <!-- Skills Table -->
    <div class="bg-white rounded-2xl border border-[#E8E5DC] overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#FAF9F6] border-b border-[#E8E5DC] text-xs font-mono uppercase text-[#78716C]">
                    <tr>
                        <th class="px-6 py-4">Skill Name</th>
                        <th class="px-6 py-4">Type</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Proficiency</th>
                        <th class="px-6 py-4">Icon</th>
                        <th class="px-6 py-4">Order</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F4F2EB]">
                    @forelse($skills as $skill)
                        <tr class="hover:bg-[#FAF9F6]/60 transition">
                            <td class="px-6 py-4 font-semibold text-[#1C1917]">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm text-[#8F6A3B]">{{ $skill->icon ?? 'circle' }}</span>
                                    <span>{{ $skill->name }}</span>
                                </div>
                                @if($skill->description)
                                    <p class="text-xs text-[#78716C] font-normal line-clamp-1 mt-0.5">{{ $skill->description }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs font-mono">
                                @if($skill->type === 'soft')
                                    <span class="px-2 py-0.5 rounded-full bg-amber-50 border border-amber-200 text-amber-800 font-medium">Soft</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full bg-stone-100 border border-stone-300 text-stone-700 font-medium">Technical</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs font-mono text-[#57534E]">
                                <span class="px-2 py-0.5 rounded bg-[#FAF9F6] border border-[#E8E5DC]">
                                    {{ $skill->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-mono font-medium border {{ $skill->level_badge_class }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $skill->level_dot_class }}"></span>
                                    <span>{{ $skill->level_label }}</span>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs font-mono text-[#78716C]">
                                {{ $skill->icon ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-xs font-mono text-[#78716C]">
                                {{ $skill->sort_order }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.skills.edit', $skill) }}" class="p-1.5 rounded hover:bg-[#F4F2EB] text-[#57534E] hover:text-[#1C1917]" title="Edit">
                                        <span class="material-symbols-outlined text-base">edit</span>
                                    </a>
                                    <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Are you sure you wish to remove this skill?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded hover:bg-rose-50 text-rose-600" title="Delete">
                                            <span class="material-symbols-outlined text-base">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-[#78716C] italic font-mono text-xs">
                                No skills recorded. Click "Add New Skill" to add one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
