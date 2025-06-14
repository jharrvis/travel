<template>
  <div>
    <Header />
    <main class="container">
      <Search />
    </main>
    <Footer />
  </div>
</template>

<script>
import Header from '@/components/Header.vue'
import Search from '@/components/Search.vue'
import Footer from '@/components/Footer.vue'
export default {
  components: { Header, Search, Footer }
}
</script>
