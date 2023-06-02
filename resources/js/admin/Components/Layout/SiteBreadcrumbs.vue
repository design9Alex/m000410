<template>
  <div class="row justify-content-between" v-if="filled(breadcrumbs)">
    <div class="col-auto">
      <nav class="ml-2 mt-1" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" v-for="(item, index) in breadcrumbs"
              :class="{'active': index === breadcrumbs.length - 1}">
            <a v-if="filled(item.url)" :href="item.url"><!--
            --><i v-if="index === 0" class="icon-home3 mr-2"></i><!--
            --><span>{{ item.title }}</span></a>
            <template v-else><!--
            --><i v-if="index === 0" class="icon-home3 mr-2"></i><!--
            --><span :class="{'text-muted': index < breadcrumbs.length - 1}">{{ item.title }}</span></template>
          </li>
        </ol>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  name: "SiteBreadcrumbs",
  props: {
    breadcrumbs: Array
  }
}
</script>
