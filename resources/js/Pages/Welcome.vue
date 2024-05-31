<template>
<div v-if="$page.props.flash.message" class="alert alert-success alert-dismissible fade show" role="alert">
  <div class="d-flex align-items-center justify-content-between">
    <div>{{ $page.props.flash.message }}</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
</div>
  <ExampleVue />
</template>

<script>
import ExampleVue from '../Components/Example.vue'

export default {
  name: 'Welcome',
  components: {
    ExampleVue
  }
}
</script>
