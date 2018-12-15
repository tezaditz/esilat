<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/25/2017
 * Time: 12:10 PM
 */
?>
@if ($paginator->lastPage() > 1)
    <ul class="pagination pagination-sm no-margin pull-right">
        <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            <a href="{{ $paginator->url(1) }}">@lang('backend/_globals.buttons.previous')</a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
            <a href="{{ $paginator->url($paginator->currentPage()+1) }}" >@lang('backend/_globals.buttons.next')</a>
        </li>
    </ul>
@endif
