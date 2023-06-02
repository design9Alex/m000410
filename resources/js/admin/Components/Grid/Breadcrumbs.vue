<template>
  <ol class="breadcrumb p-1">
    <li v-for="(breadcrumb, index) in breadcrumbs"
        class="breadcrumb-item"
        :class="{'active': parseInt(index) === (breadcrumbs.length - 1)}">
      <a v-if="filled(breadcrumb.url)" :href="breadcrumb.url">
        <i v-if="parseInt(index) === 0" class="icon-folder-open mr-2"></i><span>{{ breadcrumb.title }}</span>
      </a>
      <template v-else>
        <i v-if="parseInt(index) === 0" class="icon-folder-open mr-2"></i><span>{{ breadcrumb.title }}</span>
      </template>
    </li>
  </ol>
</template>

<script>
export default {
  name: "GridBreadcrumbs",
  props: {
    breadcrumbs: {
      type: Array,
      default: []
    }
  }
}
</script>
