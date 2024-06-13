<x-master title="Ajout de tâches">
    <main class="content px-3 py-4">
        <div class="container">
            <div class="card mb-4 border-0 shadow bg-white">
                <div class="card-header border-0 text-dark bg-white rounded-0 shadow-sm mb-3">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tasks.index') }}" class="link-secondary link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                            <i class="fas fa-plus-circle me-1"></i>
                            Ajout de tâches
                        </a>
                        <a class="btn text-white me-2 px-2 py-1 rounded-1"  style="background-color: #B46F55;" href="{{ route('tasks.index') }}">
                            <i class="fas fa-times-circle"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <div class="progressbar justify-content-evenly">
                            <div class="progress" id="progress"></div>
                            <div class="progress-step progress-step-active p-4 step0" data-title="tâches"></div>
                            <div class="progress-step p-4 step1" data-title="ressources" ></div>
                            <div class="progress-step p-4 step2" data-title="difficultés"></div>
                        </div>
                        <form action="{{ route('tasks.store') }}" method="post" class="employee-form">                        
                            @csrf    
                            <div class="form-section">   
                                <div class="row ms-5" style="width:96%;">
                                    <div class="col-md-6">
                                        <div class="mb-2">
                                            <label for="type" class="form-label m-1">Type </label>
                                            <select style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" name="type" id="type">
                                                <option value="principal" {{ old('type') == 'principal' ? 'selected' : '' }}>Principal</option>
                                                <option value="supplementaire" {{ old('type') == 'supplementaire' ? 'selected' : '' }}>Supplémentaire</option>
                                            </select>
                                        </div>
                                        @error('type')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-2">                
                                            <label for="name" class="form-label m-1"> Nom</label>                        
                                            <input type="text" style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" name="name" id="name" value="{{ old('name') }}">                       
                                        </div>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="row ms-5 my-4" style="width:100%;">
                                    <div class="col-md-12">
                                        <div class="mb-2">
                                            <label for="desc" class="form-label">Description </label>
                                            <textarea style="width: 91%;" class="form-control bg-light rounded-0 border-0 border-bottom  mt-1" id="desc" name='description' rows="2">{{ old('description') }}</textarea>
                                        </div>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror 
                                    </div>
                                </div>
                            </div>

                            <!--Ressources-->
                            <div class="form-section">
                                <!-- Champs de ressources dynamiques ajoutés par JavaScript -->
                                <div class="row ms-5" style="width:96%;">
                                    <div class="col-md-6">
                                        <div id="resourcesH">
                                            
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-light" onclick="addHumanResourceField()"><i class="fas fa-user-tie me-1"></i> Ressource humaine</button>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div id="resourcesM">
                                           
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-light" onclick="addMaterialResourceField()"><i class="fas fa-tools me-1"></i> Ressource matérielle</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Difficultées-->
                            <div class="form-section">
                                <div class="row ms-5" style="width:96%">
                                    <div class="difficulties">
                                        
                                    </div> 
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-light" onclick="addDifficultyField()"><i class="fas fa-exclamation-triangle me-2"></i> difficulté</button>
                                </div>
                            </div>
                            
                        
                            <div class="form-navigation mt-3" style="width:94%;">
                                <button type="button" class="previous btn text-white fw-bold bg-dark ms-5" style="float:left;">
                                    <i class="fas fa-chevron-circle-left me-2"></i> Précédent
                                </button>
                                <button type="button" class="next btn text-white fw-bold bg-dark" style="float:right;">
                                    Suivant <i class="fas fa-chevron-circle-right ms-2"></i>
                                </button>
                                <button type="submit" name="task" class="btn text-white fw-bold bg-dark" style="float:right;">
                                    <i class="fas fa-plus-circle me-2"></i> Soumettre
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-master>
<script>
     function addHumanResourceField() {
    const resourcesDiv = document.getElementById('resourcesH');
    const resourceIndex = resourcesDiv.children.length + 1;
    const resourceField = `
        <input type="hidden" style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" name="resource_types[]" id="resource_type_${resourceIndex}" value="humain">
        <div class="mb-2" id="resource_${resourceIndex}">
            <label for="resource_name_${resourceIndex}">Ressource humaine :</label>
            <select style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" name="resources[]" id="resource_name_${resourceIndex}">
                @foreach ($services as $service)
                    <optgroup label="{{ $service->name }}">
                        @foreach ($users->where('service_id', $service->id) as $user)
                            <option value="{{ $user->name.' '.$user->prenom }}">{{ $user->name.' '.$user->prenom }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            <button type="button" class="btn btn-dark btn-sm mt-1" onclick="removeResource('resource_${resourceIndex}')"><i class="fas fa-trash"></i></button>
        </div>
    `;
    resourcesDiv.insertAdjacentHTML('beforeend', resourceField);
}



function addMaterialResourceField() {
    const resourcesDiv = document.getElementById('resourcesM');
    const resourceIndex = resourcesDiv.children.length + 1;
    const resourceField = `
        <input type="hidden" style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" name="resource_types[]" id="resource_type_${resourceIndex}" value="materiel">
        <div class="mb-2" id="resource_${resourceIndex}">
            <label for="resource_name_${resourceIndex}">Ressource matérielle :</label>
            <input type="text" style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" name="resources[]" id="resource_name_${resourceIndex}">
            <div class="d-flex justify-content-end" style="width:90%;">
                <button type="button" class="btn btn-dark btn-sm mt-1" onclick="removeResource('resource_${resourceIndex}')"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    `;
    resourcesDiv.insertAdjacentHTML('beforeend', resourceField);
}

function addDifficultyField() {
    const difficultiesDiv = document.querySelector('.difficulties');
    const difficultyIndex = difficultiesDiv.children.length / 2 + 1;
    const difficultyField = `
        <div id="difficulty_${difficultyIndex}">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-2">
                        <label for="difficulty_${difficultyIndex}">Difficulté :</label>
                        <textarea style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" name="difficulties[]" id="difficulty_${difficultyIndex}" rows="2"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label for="solution_${difficultyIndex}">Solution :</label>
                        <textarea style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" name="solutions[]" id="solution_${difficultyIndex}" rows="2"></textarea>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end" style="width: 95%;">        
                <button type="button" class="btn btn-dark btn-sm mt-1" onclick="removeDifficulty('difficulty_${difficultyIndex}')"><i class="fas fa-trash"></i></button>
            </div>
        </div>

    `;
    difficultiesDiv.insertAdjacentHTML('beforeend', difficultyField);
}

function removeResource(id) {
    const resourceToRemove = document.getElementById(id);
    if (resourceToRemove) {
        resourceToRemove.remove();
    }
}

function removeDifficulty(id) {
    const difficultyToRemove = document.getElementById(id);
    if (difficultyToRemove) {
        difficultyToRemove.remove();
    }
}
</script>