<div class="row mb-4">
    <div class="col-lg-8 col-sm-12">
        <div class="mb-4">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                aria-describedby="name">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-8 col-sm-12">
        <div class="mb-4">
            <label for="email">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                aria-describedby="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="mb-4">
            <label for="email">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                aria-describedby="password">
            @unless ($errors->has('password'))
            <small class="form-text text-muted">Password must be at least 8 characters long</small>
            @endunless
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="mb-4">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation"
                aria-describedby="password_confirmation">
        </div>
    </div>
    <div class="col-lg-8 col-sm-12">
        <div class="mb-4">
            <label for="phone">Phone</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                aria-describedby="phone">
        </div>
        @error('phone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>