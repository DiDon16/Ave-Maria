<form action="" method="POST">
    @csrf
    @method($patient->id ? "PATCH" : "POST")
    <div class="mb-3">
        <input id="firstName" class="form-control" type="text" name="firstName" placeholder="Firstname" value={{old('firstName', $patient->firstName)}}>
        @error('firstName')
            <div class="form-control-feedback text-danger">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-3">
        <input id="lastName" class="form-control" type="text" name="lastName" placeholder="Lastname" value="{{old('lastName', $patient->lastName)}}">
        @error('lastName')
            <div class="form-control-feedback text-danger">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-3">
        <Label for="date_of_birth" class="form-label">Date de naissance</Label>
        <input id="date_of_birth" class="form-control" type="date" name="date_of_birth" value="{{old('date_of_birth', $patient->date_of_birth)}}">
        @error('date_of_birth')
            <div class="form-control-feedback text-danger">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-3">
        <select id="gender" class="form-control" name="gender">
            <option value="">Gender</option>
            @foreach ($genders as $gender)
                <option @selected(old('gender', $patient->gender) == $gender) value={{$gender}}>{{$gender}}</option>
            @endforeach
        </select>
        @error('gender')
            <div class="form-control-feedback text-danger">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-3">
        <input id="phone_number" class="form-control" type="tel" name="phone_number" placeholder="Phone number" value="{{old('phone_number', $patient->phone_number)}}">
        @error('phone_number')
            <div class="form-control-feedback text-danger">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-3">
        <input id="email" class="form-control" type="email" name="email" placeholder="Email" value="{{old('email', $patient->email)}}">
        @error('email')
            <div class="form-control-feedback text-danger">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-3">
        <input id="address" class="form-control" type="text" name="address" placeholder="Address" value="{{old('address', $patient->address)}}">
        @error('address')
            <div class="form-control-feedback text-danger">{{$message}}</div>
        @enderror
    </div>

    <button class="btn btn-primary">
        @if ($patient->id)
            Update
        @else
            Create
        @endif
    </button>
</form>
