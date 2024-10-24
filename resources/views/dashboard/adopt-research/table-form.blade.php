<div class="card mb-4">
    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
        <h6>جدول {{ $title }} ({{ $items->count() }})</h6>
    </div>

    <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ $column_name }}</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تاريخ الإنشاء</th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $item->value }}</h6>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $item->created_at->format('Y/m/d h:i') }}</span>
                        </td>
                        <td class="align-middle">
                            @if ($item)
                            <form action="{{ route($delete_route, $item->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <a href="javascript:;" class="text-danger font-weight-bold text-xs" onclick="confirmDelete({{ $item->id }})">
                                    حذف
                                </a>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            <span class="text-muted">لا توجد بيانات لعرضها</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create New Item Form -->
    <div class="card-footer">
        <form action="{{ route($create_route) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">اسم {{ $title }}</label>
                <input type="text" name="value" id="name" class="form-control @error('value') is-invalid @enderror" placeholder="أدخل الاسم" value="{{ old('value') }}">

                <!-- Validation Error Message -->
                @error('value')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">إضافة {{ $title }}</button>
        </form>
    </div>
</div>

<script>
    function confirmDelete(itemId) {
        if (confirm('هل تريد بالتأكيد حذف هذا العنصر؟')) {
            document.getElementById('delete-form-' + itemId).submit();
        }
    }
</script>
