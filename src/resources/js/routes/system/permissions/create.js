import { Permission } from './create/permission';
import { Resource } from './create/resource';

export const Create = {
    path: '',
    component: require('../../../pages/system/permissions/Create.vue'),
    meta: {
        breadcrumb: 'create',
    },
    children: [ Permission, Resource ]
};