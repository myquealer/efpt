<?php

namespace Mike\CharacterBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Mike\CharacterBundle\Entity\Characters;
use Mike\CharacterBundle\Form\CharactersType;

/**
 * Characters controller.
 *
 * @Route("/characters")
 */
class CharactersController extends Controller
{

    /**
     * Lists all Characters entities.
     *
     * @Route("/", name="characters")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MikeCharacterBundle:Characters')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Characters entity.
     *
     * @Route("/", name="characters_create")
     * @Method("POST")
     * @Template("MikeCharacterBundle:Characters:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Characters();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('characters_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Characters entity.
     *
     * @param Characters $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Characters $entity)
    {
        $form = $this->createForm(new CharactersType(), $entity, array(
            'action' => $this->generateUrl('characters_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create','attr'=>array('class'=>'btn btn-default btn-xs')));

        return $form;
    }

    /**
     * Displays a form to create a new Characters entity.
     *
     * @Route("/new", name="characters_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Characters();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Characters entity.
     *
     * @Route("/{id}", name="characters_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MikeCharacterBundle:Characters')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Characters entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Characters entity.
     *
     * @Route("/{id}/edit", name="characters_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MikeCharacterBundle:Characters')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Characters entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Characters entity.
    *
    * @param Characters $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Characters $entity)
    {
        $form = $this->createForm(new CharactersType(), $entity, array(
            'action' => $this->generateUrl('characters_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update','attr'=>array('class'=>'btn btn-default btn-xs')));

        return $form;
    }
    /**
     * Edits an existing Characters entity.
     *
     * @Route("/{id}", name="characters_update")
     * @Method("PUT")
     * @Template("MikeCharacterBundle:Characters:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MikeCharacterBundle:Characters')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Characters entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('characters_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Characters entity.
     *
     * @Route("/{id}", name="characters_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MikeCharacterBundle:Characters')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Characters entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('characters'));
    }

    /**
     * Creates a form to delete a Characters entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('characters_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr'=>array('class'=>'btn btn-default btn-xs')))
            ->getForm()
        ;
    }
}
