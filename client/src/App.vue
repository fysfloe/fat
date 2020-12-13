<template>
  <div id="app">
    <navigation/>

    <main class="container is-fluid">
      <router-view/>
    </main>
  </div>
</template>

<script>
import Navigation from "./components/layout/Navigation";
export default {
  name: 'App',
  components: {Navigation}
}
</script>

<style>
</style>
