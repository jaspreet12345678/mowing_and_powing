 <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Service Type</th>
                        <th scope="col">Recommended</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($ServicePeriod as $key => $service_data)
                        <tr>
                            <th scope="row">{{ ++$key }}</td>
                            <td>{{ $service_data->duration .' '. $service_data->duration_type }}</td>
                            <td><input type="radio" onclick="changevalue(this.value)" id="radio_box" name="radio_button"
                                    value="{{ $service_data->id }}"
                                    {{ $service_data->recommended == 'Yes' ? 'checked' : '' }}></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
  
