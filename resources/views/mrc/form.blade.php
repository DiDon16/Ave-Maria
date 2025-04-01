<form action="" method="POST">
    @csrf
    <div class="mb-3">
        <input id="creatinine_level" class="form-control" type="number" step="0.01" name="creatinine_level" placeholder="Creatinine Level" value={{old('creatinine_level', $mrcAnalysis->creatinine_level)}}>
        @error('creatinine_level')
            {{ $message }}
        @enderror
    </div>

    <div class="mb-3">
        <input id="gfr" class="form-control" type="number" step="0.01" name="gfr" placeholder="GRF Level" value="{{old('gfr', $mrcAnalysis->gfr)}}">
        @error('gfr')
            {{ $message }}
        @enderror
    </div>

    <div class="mb-3">
        <input id="albumin_level" class="form-control" type="number" step="0.01" name="albumin_level" placeholder="Albumin Level" value="{{old('albumin_level', $mrcAnalysis->albumin_level)}}">
        @error('albumin_level')
            {{ $message }}
        @enderror
    </div>

    <button class="btn btn-primary">
        @if ($mrcAnalysis->id)
            Update
        @else
            Create
        @endif
    </button>
</form>
