import { usePage } from "@inertiajs/inertia-vue3";

// Composable for checking is permission exsist
export function usePermissions(permission) {
    if(usePage().props.value.userPermissions.includes('*')){
        return true;
        
    }
    return usePage().props.value.userPermissions.includes(permission);
}
