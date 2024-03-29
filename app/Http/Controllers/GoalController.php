<?php

namespace App\Http\Controllers;

use App\Events\ActivityEvent;
use App\Http\Requests\StoreGoalRequest;
use App\Http\Requests\UpdateGoalRequest;
use App\Interfaces\GoalRepositoryInterface;
use App\Models\Account;
use App\Models\Goal;
use Illuminate\Contracts\View\View;

class GoalController extends Controller
{
    public function __construct(
        private GoalRepositoryInterface $goalRepository
    ) {}

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function show(Goal $goal): View
    {
        $this->authorize('view', $goal);
    
        return view('goals.show', [
            'goal'       => $goal,
            'titleRight' => $goal->name,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Account|null $account
     *
     * @return View
     */
    public function create(?Account $account = null): View
    {
        return view('goals.form', [
            'accountSelect' => $account,
            'method'        => 'POST',
            'route'         => route('goals.store'),
            'titleRight'    => 'Nuevo objetivo',
        ]);
    }

    public function store(StoreGoalRequest $request)
    {
        $goal = $this->goalRepository->createGoal(
            $request->only([
                'account_id',
                'amount',
                'category_id',
                'contributed',
                'description',
                'end_date',
                'name',
                'spent',
            ])
        );

        event(new ActivityEvent(
            $goal,
            'goal',
            'Objetivo creado',
            'Se ha creado la cuenta ' . $goal->name,
            route('goals.show', $goal->id)
        ));

        return redirect()->route('goals.index', $goal->account_id);
    }

    public function edit(Goal $goal): View
    {
        $this->authorize('update', $goal);

        return view('goals.form', [
            'goal'    => $goal,
            'method'     => 'PUT',
            'route'      => route('goals.update', $goal->id),
            'titleRight' => 'Editar objetivo'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateGoalRequest $request
     * @param  Goal              $goal
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGoalRequest $request, Goal $goal)
    {
        $this->authorize('update', $goal);

        $this->goalRepository->updateGoal(
            $goal,
            $request->only([
                'account_id',
                'amount',
                'category_id',
                'contributed',
                'description',
                'end_date',
                'name',
                'spent',
            ])
        );

        $goal = $goal->refresh();

        event(new ActivityEvent(
            $goal,
            'goal',
            'Objetivo actualizado',
            'Se ha actualizado el objetivo '.$goal->name,
            route('goals.show', $goal->id)
        ));

        return redirect()->route('goals.index', $goal->account_id);
    }

    public function destroy(Goal $goal)
    {
        $this->authorize('delete', $goal);

        $this->goalRepository->deleteGoal($goal);

        event(new ActivityEvent(
            $goal,
            'goal',
            'Objetivo eliminado',
            'Se ha eliminado el objetivo '.$goal->name,
            ''
        ));

        return redirect()->route('goals.index', $goal->account_id);
    }
}
