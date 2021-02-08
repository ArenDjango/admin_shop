<div class="left-menu">
    <div class="burger"><i class="fa fa-bars"></i></div>
    <h2 class="mb-4">Dashboard</h2>
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" href="{{ route('menu.dashboard') }}">SUMMARY</a>
        <div class="menu">
            <div id="product-dropdown">PRODUCT</div>
            <div id="submenu">
                @if(Auth::user()->role == 'admin')
                <a class="nav-link" data-toggle="modal" href="javascript:;" data-target="#addCategory"> - Add category</a>
                @endif
                @foreach($categories as $category)
                    <a class="nav-link" href="{{ route('menu.category', $category->id) }}" role="tab"
                      >{{ $category->category_title }}</a>
                @endforeach
            </div>
        </div>
        @if(Auth::user()->role == 'admin')
            <a class="nav-link" href="{{ route('menu.users') }}" >USERS</a>
        @endif
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('menu.add_category') }}" method="POST">
                <div class="modal-body">

                        @csrf
                        <div class="form-group">
                            <input type="text" placeholder="Category title" class="form-control" name="title" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
