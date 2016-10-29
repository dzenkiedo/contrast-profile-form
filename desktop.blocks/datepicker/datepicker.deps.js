({
  mustDeps : { block : 'i-bem', elem : 'dom' },
  shouldDeps: [
    { block: 'popup', mods: { theme: 'islands' } },
        {
            block : 'popup',
            mods : {
                autoclosable : true,
                target : 'anchor'
            }
        },
    { block: 'button', mods: { theme: 'islands' } },
    { block: 'dropdown' },
    { block: 'datepicker', elem: 'dropdown', mods: { open: true } },
    { block: 'control-group', mods: { dropdown: true } }
  ]
})
