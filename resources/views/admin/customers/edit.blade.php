<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Customer')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.customers.update', $model->id)}}" method="post" :default="$model">

          <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
          <x-splade-input :label="__('Email')" name="email" type="email"  :placeholder="__('Email')" />
          <x-tomato-admin-tel :label="__('Phone')" :placeholder="__('Phone')" type='tel' name="phone" />
          <x-splade-input :label="__('Balance')" :placeholder="__('Balance')" type='number' name="balance" />
          <x-splade-textarea :label="__('Address')" name="address" :placeholder="__('Address')" autosize />
          <x-tomato-admin-rich :label="__('Bio')" name="bio" :placeholder="__('Bio')" autosize />
          <x-splade-input :label="__('Birthday')" :placeholder="__('Birthday')" name="birthday" date />
          <x-splade-input :label="__('Time')" :placeholder="__('Time')" name="time" time="{ time_24hr: false }" />
          <x-tomato-admin-color :label="__('Color')" :placeholder="__('Color')" type='number' name="color" />
        <x-tomato-admin-icon :label="__('Icon')" name="icon" type="icon"  :placeholder="__('Icon')" />
        <x-tomato-admin-code :label="__('Html')" name="html" :placeholder="__('Html')" />

          <x-splade-checkbox :label="__('Is active')" name="is_active" label="Is active" />


        <x-tomato-admin-repeater name="info" :options="['key', 'value', 'type']" label="{{__('Info')}}">
            <div class="flex flex-col gap-4">
                <x-splade-input :label="__('Key')" v-model="repeater.main[key].key" type="text"  :placeholder="__('Key')" />
                <x-splade-input :label="__('Value')" v-model="repeater.main[key].value" type="text"  :placeholder="__('Value')" />
                <x-splade-select choices :options="['text', 'number']" :label="__('Type')" v-model="repeater.main[key].type" :placeholder="__('Type')" />
            </div>
        </x-tomato-admin-repeater>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.customers.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.customers.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
