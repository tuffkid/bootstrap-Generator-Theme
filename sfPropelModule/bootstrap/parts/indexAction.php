    public function executeIndex(sfWebRequest $request)
    {
        if ($request->getParameter('filters'))
        {
            $this->setFilters($request->getParameter('filters'));
        }

        if ($request->getParameter('sort'))
        {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        if ($request->getParameter('page'))
        {
            $this->setPage($request->getParameter('page'));
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
    }
