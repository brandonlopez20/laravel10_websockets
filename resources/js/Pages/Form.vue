<template>
  <h1 class="container">{{ $page.props.title }}</h1>
  <form @submit.prevent="submit" class="container mt-5">
    <div class="mb-3">
      <label for="first_name" class="form-label">First name:</label>
      <input type="text" class="form-control" id="first_name" v-model="form.name" />
      <span v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</span>
    </div>
    <button type="submit" class="btn btn-primary" :disabled="form.processing">Submit</button>
  </form>
</template>

<script setup>


import { useForm, usePage } from '@inertiajs/vue3';

const page = usePage()

defineProps({ 
  errors: Object
})

const form = useForm({
  name: '',
})

function submit() {
  form.post('formulario', {
    onError: (e) => {
      console.log(e)
    }
  })
 
}
</script>
