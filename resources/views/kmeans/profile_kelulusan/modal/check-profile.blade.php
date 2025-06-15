<x-adminlte-modal id="profileModal" title="Check Graduation Profile" size="lg" theme="info"
                  icon="fas fa-fw fa-graduation-cap" v-centered static-backdrop scrollable>
    <form id="profileForm" method="POST">
        @csrf
        <div class="form-group">
            <label for="semester_5">Semester 5 Subjects</label>
            <select class="form-control" id="semester_5" name="semester_5[]" multiple required>
                <option value="Sistem Informasi Perusahaan">Sistem Informasi Perusahaan</option>
                <option value="Business Process Reengineering">Business Process Reengineering</option>
                <option value="E-Commerce">E-Commerce</option>
                <option value="Data Mining">Data Mining</option>
            </select>
            <small class="form-text text-muted">Hold Ctrl (Windows) or Command (Mac) to select multiple.</small>
        </div>
        <div class="form-group">
            <label for="semester_6">Semester 6 Subjects</label>
            <select class="form-control" id="semester_6" name="semester_6[]" multiple required>
                <option value="Sistem Pendukung Keputusan">Sistem Pendukung Keputusan</option>
                <option value="Sistem Informasi Pemerintahan">Sistem Informasi Pemerintahan</option>
                <option value="Digital Marketing">Digital Marketing</option>
                <option value="Machine Learning">Machine Learning</option>
            </select>
        </div>
        <div class="form-group">
            <label for="semester_7">Semester 7 Subjects</label>
            <select class="form-control" id="semester_7" name="semester_7[]" multiple required>
                <option value="UI/UX Design">UI/UX Design</option>
                <option value="Manajemen Resiko TI/SI">Manajemen Resiko TI/SI</option>
                <option value="Supply Chain Management">Supply Chain Management</option>
                <option value="Internet of Things">Internet of Things</option>
            </select>
        </div>
        <div id="profileResult" class="alert alert-info mt-3" style="display:none;"></div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Check Profile</button>
        </div>
    </form>
</x-adminlte-modal>
