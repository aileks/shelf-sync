<script setup>
  import {onMounted, onUnmounted, ref} from 'vue'

  const animate = ref(false)

  onMounted(() => {
    animate.value = true
  })

  onUnmounted(() => {
    animate.value = false
  })
</script>

<template>
  <Transition
      enter-active-class="transition-all ease-out duration-700"
      enter-from-class="translate-y-10"
      leave-active-class="transition-all ease-out duration-700"
      leave-to-class="translate-y-10 opacity-0"
  >
    <div v-show="animate"
         class="mt-8 p-2 text-center">
      <slot/>
    </div>
  </Transition>
</template>