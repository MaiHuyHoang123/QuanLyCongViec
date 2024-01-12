<div x-data="{multi_select: false}" @click.outside='multi_select = false'>
     <input hidden type="text" name="{{ $name ?? '' }}" class=" {{ $class ?? '' }}" placeholder="{{ $placeholder ?? "nhập thông tin ..." }}">
     <span @click="multi_select = true" contenteditable="true" class="form-control bg-transparent border-primary list-item-selected" style="padding: 5px"></span>
     <select x-show="multi_select" class="form-select form-control bg-transparent border-primary" id="{{ $id }}" aria-label="Default select example" multiple>
          <option>None ...</option>
          {{ $slot }}
     </select>
</div>