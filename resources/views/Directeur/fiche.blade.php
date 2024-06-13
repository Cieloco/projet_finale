<div   class="table-responsive" id="dynamic-table">
    <table border="1" class="table table-bordered text-center">
        <thead class="thead-light">
            <tr>
                <th>ID Tache</th>
                <th>Tache</th>
                <th>Date de Creation</th>
                <th>Responsable de Tache</th>
                <th>Type de Tache</th>
                <th>Service</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{$task->id}}</td>
                    <td>{{$task->name}}</td>
                    <td>{{$task->created_at->format("Y-m-d")}}</td>
                    <td>{{$task->utilisateur->name}}</td>
                    <td>{{$task->type}}</td>
                    <td>{{$task->service->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<style>

table {
  table-layout: fixed;
  width: 100%;
  border-collapse: collapse;
  border: 3px solid purple;
}

thead th:nth-child(1) {
  width: 30%;
}

thead th:nth-child(2) {
  width: 20%;
}

thead th:nth-child(3) {
  width: 15%;
}


</style>
