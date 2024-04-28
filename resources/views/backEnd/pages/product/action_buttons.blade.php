<div class="actions">
    <a href="{{ route('admin.product.edit', $id) }}"
        class="btn btn-info">Edit</a>
    <a href="#" class="btn btn-danger"
        onclick="
    event.preventDefault();
    document.getElementById('delete-product-{{ $id }}').submit();
    ">Delete</a>

    <form action="{{ route('admin.product.destroy', $id) }}" method="post"
        id="delete-product-{{ $id }}">
        @csrf
        @method('DELETE')
    </form>
</div>