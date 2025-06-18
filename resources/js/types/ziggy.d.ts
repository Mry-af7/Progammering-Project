import { RouteParams, Router } from 'ziggy-js';

declare global {
    function route(): Router;
    function route(name: string, params?: RouteParams<typeof name> | undefined, absolute?: boolean): string;
}

declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        route: typeof route;
    }
}

declare interface ZiggyRoute {
    (name: string, params?: Record<string, any>, absolute?: boolean): string;
    current(): string;
    check(name: string): boolean;
}

declare const route: ZiggyRoute;

export { route };
