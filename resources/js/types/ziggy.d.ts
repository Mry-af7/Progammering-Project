import { Config, RouteParams, Router } from 'ziggy-js';

declare global {
    type ValidRouteName = keyof ZiggyRoute;

    interface ZiggyRoute {
        login: string;
        'password.request': string;
        'password.email': string;
        'password.reset': string;
        'password.store': string;
        register: string;
        'register.bedrijf': string;
        // Add other route names as needed
    }

    function route(): Router;
    function route(name: undefined, params: undefined, absolute?: boolean, config?: Config): Router;
    function route<T extends ValidRouteName>(
        name: T,
        params?: RouteParams | undefined,
        absolute?: boolean,
        config?: Config
    ): string;

    interface Window {
        Ziggy: {
            routes: Record<string, any>;
            url: string;
            port: number | null;
            defaults: Record<string, any>;
            location: string;
        };
        route: typeof import('ziggy-js').default;
    }
}

declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        route: typeof route;
    }
}

declare module 'ziggy-js' {
    interface RouteConfig {
        uri: string;
        methods: string[];
        domain?: string | null;
        bindings?: Record<string, string>;
        parameters?: string[];
        wheres?: Record<string, string>;
    }

    interface ZiggyConfig {
        url: string;
        port: number | null;
        defaults: Record<string, string>;
        routes: Record<string, RouteConfig>;
    }

    type RouteParam = string | number | Record<string, any>;
    type RouteParamsWithQueryOverload = RouteParam | RouteParam[] | Record<string, RouteParam>;

    interface ZiggyRouter {
        current(): string;
        current(name: string): boolean;
        check(name: string): boolean;
        has(name: string): boolean;
    }

    type RouteFunction = {
        (name: string, params?: RouteParamsWithQueryOverload, absolute?: boolean): string;
        (): ZiggyRouter;
        current(): string;
        current(name: string): boolean;
        check(name: string): boolean;
        has(name: string): boolean;
    }

    interface ZiggyRouteParams {
        [key: string]: any;
    }

    interface ZiggyRouteQuery {
        [key: string]: any;
    }

    interface ZiggyRouteOptions {
        absolute?: boolean;
        domain?: string;
        secure?: boolean;
        preserveState?: boolean;
        preserveScroll?: boolean;
        replace?: boolean;
        only?: string[];
        except?: string[];
        headers?: Record<string, string>;
        errorBag?: string;
        onBefore?: () => void;
        onStart?: () => void;
        onProgress?: (progress: any) => void;
        onFinish?: () => void;
        onCancel?: () => void;
        onSuccess?: (page: any) => void;
        onError?: (errors: any) => void;
    }

    function route(
        name?: string,
        params?: ZiggyRouteParams | ZiggyRouteQuery,
        absolute?: boolean,
        config?: ZiggyRouteOptions
    ): string;

    function route(
        name: string,
        params?: ZiggyRouteParams | ZiggyRouteQuery,
        absolute?: boolean,
        config?: ZiggyRouteOptions
    ): string;

    export default route;
}

declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        route: (name: string, params?: any) => string;
    }
}

declare module '@/types/ziggy' {
    export function route(name: string, params?: Record<string, any>, absolute?: boolean): string;
}

export { route };
