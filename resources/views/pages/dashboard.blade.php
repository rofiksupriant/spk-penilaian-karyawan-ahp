<x-app-layout>

  @slot('content')
  <div class="container-fluid py-2">
    <div class="row">
      <div class="card col-12 p-4">
        <h4 class="mb-2">Top 3 Employees</h4>

        <div class="row">
          @foreach ($topEmployees as $employee)
          <div class="col-md-4">
            <div class="card mb-3">
              <div class="card-body">
                <h5 class="card-title">{{ $employee->name }}</h5>
                <p class="card-text">Score: {{ $employee->value }}</p>
                <!-- Add more information about the employee as needed -->
              </div>
            </div>
          </div>
          @endforeach
        </div>

      </div>
    </div>
  </div>
  </div>
  @endslot

</x-app-layout>