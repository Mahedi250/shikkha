
@if ($fees)
    <tr data-id="{{ $fees->id }}">
        <td>
            <p class="m-0 mt-2 text-navy-blue">
                {{  $fees->fees_name }}</p>
            <input type="hidden" name="fees_type[]" class="fees_type" value="{{ $fees->fees_name }}" />
        </td>

        <td>
            <p class="m-0 text-navy-blue">{{ $fees->amount }}</p>
            <input type="hidden" name="fees_type_amount[]"  class="fees_type_amount" value="{{ $fees->amount }}" />
        </td>
        <td>
            <button type="button" name="remove" class="btn btn-sm btn-danger btn_remove mt-1">X</button>
        </td>
    </tr>
@else
    <tr data-id="{{ $fees->id }}">
        <td>
            <p class="m-0 mt-2 text-navy-blue">
                {{  $fees->fees_name }}</p>
            <input type="hidden" name="fees_type[]" class="fees_type" value="{{ $fees->fees_name }}" />
        </td>

        <td>
            <p class="m-0 text-navy-blue">{{ $fees->amount }}</p>
            <input type="hidden" name="fees_type_amount[]" class="fees_type_amount" value="{{ $fees->amount }}" />
        </td>
        <td>
            <button type="button" name="remove" class="btn btn-sm btn-danger btn_remove mt-1">X</button>
        </td>
    </tr>
@endif
