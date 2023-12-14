<x-app-layout>
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8 text-primary">Welcome back, {{auth()->user()->name}} !</h4>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Pariatur dignissimos suscipit alias velit voluptas? Alias sunt hic, exercitationem similique corporis ab dicta ratione iste suscipit laborum ut distinctio inventore sint!</p>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('theme/images/breadcrumb/ChatBc2.png') }}" alt="" class="img-fluid mb-n8">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
