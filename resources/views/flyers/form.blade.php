@inject('countries', 'App\Http\Utilities\Country')

        <div class="form-group">

            <label for="street">Street:</label>
            <input type="text" name="street" id="street" class="form-control" value="">

        </div>


        <div class="form-group">

            <label for="city">City:</label>
            <input type="text" name="city" id="city" class="form-control" value="">

        </div>

        <div class="form-group">

            <label for="zip">Zip/Postal Code:</label>
            <input type="text" name="zip" id="zip" class="form-control" value="">

        </div>

        <div class="form-group">

            <label for="country">Country:</label>
            <select id="country" name="country" class="form-control"  value="">
                @foreach ( $countries::all() as $country => $code )
                    <option value="{{ $code }}">{{ $country }}</option>
                @endforeach
            </select>

        </div>

        <div class="form-group">

             <label for="description">Description:</label>
             <textarea type="text" name="description" id="description" class="form-control"  value="" rows="10">


             </textarea>

        </div>

        <div class="form-group">

             <label for="price">Price:</label>
             <input type="text" name="price" id="price" class="form-control" value="">

        </div>

        <div class="form-group">

             <label for="photos">Price:</label>
             <input type="file" name="photos" id="photos" class="form-control" value="">

        </div>

        <div class="form-group">

             <button type="submit" class="btn btn-primary">Create Flyer</button>

        </div>

