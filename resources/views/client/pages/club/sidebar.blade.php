@push('css')
<style>
    .dropdown-item {
        color: gray;
    }

    .dropdown-item:hover {
        color: #E96840;
    }

    .dropdown-item::before {
        display: inline-block;
        content: '\f105';
        font-family: 'FontAwesome';
        font-size: 13px;
        color: #999999;
        margin-right: 10px;
    }
</style>
@endpush
