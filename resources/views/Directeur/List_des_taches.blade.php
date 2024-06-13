<x-master title="list des taches ">
    <main class="content px-3 py-4">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
        <div class="container-fluid">
            <div class="card mb-4 border-0 shadow bg-white">
                <div class="card-header border-0 text-white py-1" style="background-color: #B46F55; border-radius: 0;">
                    <i class="fas fa-table me-1"></i>
                    Liste des tâches Réalisées
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="dropdown">
                            <a class="btn btn-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Choisir de un Fonctionnaire</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @foreach ($utilisateurs as $utilisateur)
                                    @if($utilisateur->role=="fonctionnaire")
                                        <li><a href="{{route('/filterFonctionnaire',$utilisateur->id)}}" class="dropdown-item text-muted">{{$utilisateur->name}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="dropdown ms-3">
                            <a class="btn btn-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Choisir de une Date</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @foreach ($months as $key=>$month)
                                    <li><a href="{{route('/filterDate',$key)}}" class="dropdown-item text-muted">{{$month}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="dropdown ms-3">
                            <a class="btn btn-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Choisir de un service</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @foreach ($services as $service)
                                    @if($service->name !== "none")
                                        <ul><a href="{{route('/filterService',$service->id)}}" class="text-muted">{{$service->name}}</a></ul>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <br/>
                    <div class="table-responsive" >
                        <table class="table table-bordered text-center" id="dynamic-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID Tache</th>
                                    <th>Tache</th>
                                    <th>Date de Creation</th>
                                    <th>Responsable de Tache</th>
                                    <th>Type de Tache</th>
                                    <th>Service</th>
                                    <th>Action</th>
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
                                        <td><a class="btn btn-info px-3 text-black-50" href="{{route("/détail_de_tache",$task->id)}}"><i class="fas fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$tasks->links()}}
                </div>
                <div class="card-footer border-0 shadow text-center">
                    <button onclick="exportToExcel()" class="btn btn-success">Télécharger sous formant Excel</button>
                    <button onclick="exportToPDF()" class="btn btn-danger">Télécharger sous formant PDF</button>
                <script>
                    function exportToExcel() {
                        const table = document.getElementById("dynamic-table");
                        const rows = table.querySelectorAll("tbody tr");
                        const headers = Array.from(table.querySelectorAll("thead th")).map(th => th.textContent);
                        headers.pop();
                        if (rows.length === 0) {
                            alert("No rows to export!");
                            return;
                        }
                        const wb = XLSX.utils.book_new();
                        const ws = XLSX.utils.aoa_to_sheet([headers]);
                        rows.forEach(row => {
                            const rowData = [];
                            row.querySelectorAll("td:not(:last-child)").forEach(cell => { // Exclude the last td element in each row
                                rowData.push(cell.textContent);
                            });
                            XLSX.utils.sheet_add_aoa(ws, [rowData], {origin: -1});
                        });
                        XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
                        const wbout = XLSX.write(wb, {bookType:'xlsx', type:'array'});
                        const blob = new Blob([wbout], {type: 'application/octet-stream'});
                        const link = document.createElement('a');
                        link.href = URL.createObjectURL(blob);
                        link.download = "exported_data.xlsx";
                        link.click();
                    }
                    function exportToPDF() {
                        const table = document.getElementById('dynamic-table').cloneNode(true); // Clone the table
                        const actionCells = table.querySelectorAll('td:last-child');
                        actionCells.forEach(cell => {
                            cell.innerHTML = ''; // Remove content of action cells
                        });
                        const actionCellss = table.querySelectorAll('th:last-child');
                        actionCellss.forEach(cell => {
                            cell.innerHTML = ''; // Remove content of action cells
                        });
                        html2pdf().from(table).save();
                    }
                </script>
                </div>
            </div>
        </div>
    </main>
</x-master>
