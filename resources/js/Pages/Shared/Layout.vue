<script setup>
  import {onMounted, onUnmounted, ref} from 'vue'

  const animate = ref(false)

  onMounted(() => {
    animate.value = true
  })
</script>

<template>
  <Transition
      enter-active-class="transition-all ease-out duration-700"
      enter-from-class="-translate-y-8"
      leave-active-class="transition-all ease-out duration-700"
      leave-to-class="-translate-y-8 opacity-0"
  >
    <div v-show="animate"
         class="mt-4 p-2 text-center overflow-none">
      <slot/>
    </div>
  </Transition>
</template>
