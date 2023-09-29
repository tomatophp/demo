<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('customers')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
          <x-tomato-admin-row :label="__('Name')" :value="$model->name" type="string" />

          <x-tomato-admin-row :label="__('Email')" :value="$model->email" type="email" />

          <x-tomato-admin-row :label="__('Phone')" :value="$model->phone" type="tel" />

          <x-tomato-admin-row :label="__('Balance')" :value="$model->balance" type="number" />

          <x-tomato-admin-row :label="__('Address')" :value="$model->address" type="text" />

          <x-tomato-admin-row :label="__('Bio')" :value="$model->bio" type="rich" />

          <x-tomato-admin-row :label="__('Birthday')" :value="$model->birthday" type="text" />

          <x-tomato-admin-row :label="__('Time')" :value="$model->time" type="text" />

          <x-tomato-admin-row :label="__('Color')" :value="$model->color" type="color" />

          <x-tomato-admin-row :label="__('Icon')" :value="$model->icon" type="icon" />

          <x-tomato-admin-row :label="__('Html')" :value="$model->html" type="rich" />

          
          <x-tomato-admin-row :label="__('Is active')" :value="$model->is_active" type="bool" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.customers.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.customers.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.customers.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
