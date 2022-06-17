@php
    $isSingle = $subMenu == null ? true : false;
    $role = Auth::user()->role;
@endphp

@if (in_array($role,$access) || $access == ['all'])
<li class="sidebar-item">
    <a @class([
    'sidebar-link',
    'waves-effect',
    'waves-dark',
    'two-column' => $twoColumn,
    'has-arrow'=> !$isSingle,
    ]) href="{{ $href }}" aria-expanded="false">
    <i data-feather="{{ $icon }}" class="feather-icon"></i>
    <span class="hide-menu">{{ $text }} </span>
    </a>

    @if (!$isSingle)
    <ul aria-expanded="false" class="collapse first-level">
        @foreach ($subMenu as $item)
        <li class="sidebar-item">
            <a href="{{ $item['href'] }}" class="sidebar-link">
                <i class="fa {{ $item['icon'] }}"></i>
                <span class="hide-menu"> {{ $item['text'] }} </span>
            </a>
        </li>
        @endforeach
    </ul>
    @endif
</li>
@endif
