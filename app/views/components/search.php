<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 mb-4">
      <form action="/movies/search" method="GET">
        <div class="input-group shadow-sm">
          <input 
            type="text" 
            name="query" 
            class="form-control form-control-lg" 
            placeholder="Search for a movie..." 
            aria-label="Search for a movie" 
            required
          >
          <button class="btn btn-primary btn-lg" type="submit">
            Search
          </button>
        </div>
      </form>
    </div>
  </div>
</div>