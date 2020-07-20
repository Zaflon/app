<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-center"> {{ $username }}</div>

    <!-- attributes of this module -->
    <form style="display: hidden" id="data">
        <input type="hidden" name="controller" value="{{ $controller }}">
        <input type="hidden" name="date" value="{{ $date }}">
        <input type="hidden" name="url" value="{{ $url }}">
        <input type="hidden" name="csrf" value="{{ $csrf }}">
    </form>

    <!-- Wrapper Modules -->
    <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-light font-weight-bold group" data-target="widespread">🔑 Widespread</a>
        <div class="wrapper-widespread">
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Dashboard</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Shortcuts</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Overview</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Profile</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Status</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Parameter</a>
        </div>
        <a href="#" class="list-group-item list-group-item-action bg-light font-weight-bold group" data-target="user">🔑 User</a>
        <div class="wrapper-user">
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Panel</a>
        </div>
        <a href="#" class="list-group-item list-group-item-action bg-light font-weight-bold group" data-target="register">🔑 Register</a>
        <div class="wrapper-register">
            <a href="{{ route('Color.index') }}" class="list-group-item list-group-item-action bg-light">🗝 Color</a>
            <a href="{{ route('Brand.index') }}" class="list-group-item list-group-item-action bg-light">🗝 Brand</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Category</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Event</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Inventory</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Measurement Unit</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 NCM</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Person</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Printer</a>
            <a href="{{ route('Product.index') }}" class="list-group-item list-group-item-action bg-light">🗝 Product</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Schedule</a>
        </div>
        <a href="#" class="list-group-item list-group-item-action bg-light font-weight-bold group" data-target="stock">🔑 Stock</a>
        <div class="wrapper-stock">
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Product Logger</a>
        </div>
        <a href="#" class="list-group-item list-group-item-action bg-light font-weight-bold group" data-target="sale">🔑 Sale</a>
        <div class="wrapper-sale">
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Devolution</a>
        </div>
        <a href="#" class="list-group-item list-group-item-action bg-light font-weight-bold group" data-target="report">🔑 Report</a>
        <div class="wrapper-report">
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Sale Commission Report</a>
        </div>
        <a href="#" class="list-group-item list-group-item-action bg-light font-weight-bold group" data-target="finance">🔑 Finance</a>
        <div class="wrapper-finance">
            <a href="#" class="list-group-item list-group-item-action bg-light">🗝 Installment</a>
        </div>
    </div>

</div>