@props(['register'])
<div class="d-flex py-1 align-items-center">
  <span class="avatar avatar-2 me-2" style="background-image: url({{ $register->photo() }})"> </span>
  <div class="flex-fill">
    <div class="font-weight-medium">{{ $register->childname }}</div>
    <div class="text-secondary">{{ $register->getGender() }}</div>
  </div>
</div>